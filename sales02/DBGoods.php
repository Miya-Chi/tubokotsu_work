<?php
require_once('db.php');

$db = new DB();
$search = $db->Connectdb();

class DBGoods extends DB
{
    //goodsテーブルのCRUD担当
    public function SelectGoodsAll()
    {
        {
            //column別ソート
            $column = 'GoodsID';
            switch ($_GET['column']) {
                case "GoodsID":
                    $column = 'GoodsID';
                    break;
                case "GoodsName":
                    $column = 'GoodsName';
                    break;
            }
            // Sort
            $sort = 'ASC';
            $sortLink = 'ASC';
            switch ($_GET['sort']) {
                case "ASC":
                    $sort = 'ASC';
                    $sortLink = 'DESC';
                    break;
                case "DESC":
                    $sort = 'DESC';
                    $sortLink = 'ASC';
                    break;
            }
        }


        // LIMIT, OFFSET
        if (!isset($_GET['page'])) {
            $_GET['page'] = 1;
        }
        $limit = 5;
        $offset = ($_GET['page'] - 1) * $limit;
        $nowPage = $_GET['page'];


        // Execute SQL.
        $sql = "SELECT * FROM goods ORDER BY {$column} {$sort} LIMIT {$limit} OFFSET {$offset}";
        $res = parent::executeSQL($sql, null);
        // Generate HTML.
        $data = "<table class='recordlist' id='goodsTable'>";

        $data .= <<<eof
<tr>
    <th><a href="?column=GoodsID&sort=$sortLink&page=$nowPage">ID</a></th>
    <th><a href="?column=GoodsName&sort=$sortLink&page=$nowPage">商品名</a></th>
    <th>単価</th>
    <th></th>
    <th></th>
</tr>
eof;
        foreach ($rows = $res->fetchAll(PDO::FETCH_NUM) as $row) {
            $data .= "<tr>";
            for ($i = 0; $i < count($row); $i++) {
                $data .= "<td>{$row[$i]}</td>";
            }
            $data .= <<<eof
      <td><form method='post' action=''>
      <input type='hidden' name='id' value='{$row[0]}'>
      <input type='submit' name='update' value='更新'>
      </form></td>
eof;
            //削除ボタンのコード
            $data .= <<<eof
      <td><form method='post' action=''>
      <input type='hidden' name='id' id='Deleteid' value='{$row[0]}'>
      <input type='submit' name='delete' id='delete' value='削除'
       onClick='return CheckDelete()'>
      </form></td>
eof;
            $data .= "</tr>\n";
        }
        $data .= "</table>\n";
        return $data;
    }


    /**
     * Get total number of goods.
     */
    public function getTotalNumber()
    {
        $sql = "SELECT COUNT(*) as total FROM goods";
        $res = parent::executeSQL($sql, null);
        $results = $res->fetchAll(PDO::FETCH_ASSOC);
        return $results[0]['total'];
    }


    public function InsertGoods()
    {
        $sql = "INSERT INTO goods VALUES(?,?,?)";
        $array = array($_POST['GoodsID'], $_POST['GoodsName'], $_POST['Price']);

        //        配列
        $errorMessages = array("IDの入力は必須です。", "商品名の入力は必須です。", "単価は半角数字で入力してください。");
        $returnError = [];

        if ($_POST['GoodsID'] == null || strcmp($_POST['GoodsID'], "") == 0) {
            array_push($returnError, $errorMessages[0]);
        }
        if ($_POST['GoodsName'] == null || strcmp($_POST['GoodsName'], "") == 0) {
            array_push($returnError, $errorMessages[1]);
        }
        if (!preg_match("/^[0-9]+$/", $_POST['Price'])) {
            # 半角数字以外が含まれていた場合、false
            array_push($returnError, $errorMessages[2]);
        }
        if (!empty($returnError)) {
            return $returnError;
        }
        parent:: executeSQL($sql, $array);

    }

    public function UpdateGoods()
    {
        $sql = "UPDATE Goods SET GoodsName=?, Price=? WHERE GoodsID=?";
//        var_dump($sql);die;
        //array関数の引数の順番に注意する
        $array = array($_POST['GoodsName'], $_POST['Price'], $_POST['GoodsID']);
        parent::executeSQL($sql, $array);
    }

    public function GoodsNameForUpdate($GoodsID)
    {
        return $this->FieldValueForUpdate($GoodsID, "GoodsName");
    }

    public function PriceForUpdate($GoodsID)
    {
        return $this->FieldValueForUpdate($GoodsID, "Price");
    }

    private function FieldValueForUpdate($GoodsID, $field)
    {
        //private関数　上の2つの関数で使用している
        $sql = "SELECT {$field} FROM goods WHERE GoodsID=?";
        $array = array($GoodsID);
        $res = parent::executeSQL($sql, $array);
        $rows = $res->fetch(PDO::FETCH_NUM);
        return $rows[0];
    }

    public function DeleteGoods($GoodsID)
    {
        $sql = "DELETE FROM goods WHERE GoodsID=?";
        $array = array($GoodsID);
        parent::executeSQL($sql, $array);
    }

    public function SearchGoods($GoodsName)
    {
        $name = $_GET['name'];
        $sql = "SELECT * FROM goods WHERE GoodsName LIKE '%{$name}%'";
        $array = array($GoodsName);
        $res = parent::executeSQL($sql, $array);
        $search = "<table class='recordlist' id='goodsTable'>";
        $search .= <<<eof
        <tr>
            <th>ID</th>
            <th>商品名</th>
            <th>単価</th>
            <th></th>
            <th></th>
        </tr>
eof;
        foreach ($searchList = $res->fetchAll(PDO::FETCH_NUM) as $item) {
            $search .= "<tr>";
            for ($i = 0; $i < count($item); $i++) {
                $search .= "<td>{$item[$i]}</td>";
            }
                $searchList .= "</tr>\n";
            $searchList .= "</table>\n";
            }
            return $search;
        }
}