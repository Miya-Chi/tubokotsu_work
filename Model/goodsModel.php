<?php
require_once('../sales02/db.php');

$db = new DB();
Class DBGoods02 extends DB
{
    public $column;
    public $sort;

    const column = 'GoodsID';
    const sort = 'ASC';
    const sortLink = 'ASC';


    public function setSelectGoods()
    {
        {
            $this->column = self::column;
            $this->sort = self::sort;
            $this->sortLink = self::sortLink;

            //column別ソート
            //        $column = 'GoodsID';
            switch ($_GET['column']) {
                case "GoodsID":
                    $columnID = 'GoodsID';
                    $this->column = $columnID;
                    break;
                case "GoodsName":
                    $columnName = 'GoodsName';
                    $this->column = $columnName;
                    break;
            }
            // Sort
            switch ($_GET['sort']) {
                case "ASC":
                    $sorting = 'ASC';
                    $this->sort = $sorting;
                    $sortingLink = 'DESC';
                    $this->sortLink = $sortingLink;
                    break;
                case "DESC":
                    $sorting = 'DESC';
                    $this->sort = $sorting;
                    $sortingLink = 'ASC';
                    $this->sortLink = $sortingLink;
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
    }

    public function getSelectGoods()
    {
        $this->setSelectGoods();
        $this->limit;
        $this->offset;
        $this->nowPage;
        // Execute SQL.
        $sql = "SELECT * FROM goods ORDER BY {$this->column} {$this->sort} LIMIT {$this->limit} OFFSET {$this->offset}";
        $res = parent::executeSQL($sql, null);
        // Generate HTML.
        $paramID = '?column=GoodsID&sort=' .$this->sortLink .'&page=' .$this->nowPage;
        $paramGoodsName ='?column=GoodsName&sort=' .$this->sortLink .'&page=' .$this->nowPage;
        $data = "<table class='recordList' id='goodsTable'>";

        $data .= <<<eof
        <tr>
            <th><a href="<?php $paramID ?>">ID</a></th>
            <th><a href="<?php $paramGoodsName ?>">商品名</a></th>
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
              <input type='hidden' name='id' id='DeleteId' value='{$row[0]}'>
              <input type='submit' name='delete' id='delete' value='削除'
               onClick='return CheckDelete()'>
              </form></td>
eof;
            $data .= "</tr>\n";
        }
        $data .= "</table>\n";
        return $data;
    }
    public function showErrorMessages()
    {
        if (!empty($errorMessages)) {

            foreach ($errorMessages as $errorMessage) {
                echo $errorMessage;
            }
        }
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


    public function getInsertGoods()
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
    //            var_dump($returnError);die;
            return $returnError;
        }
    //        var_dump($sql);die;
        parent:: executeSQL($sql, $array);
    }

    public function setUpdateGoods()
    {
        $sql = "UPDATE Goods SET GoodsName=?, Price=? WHERE GoodsID=?";
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

    public function getDeleteGoods($GoodsID)
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
        $search = "<table class='recordList' id='goodsTable'>";
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
    //                var_dump($search);
            }
            $searchList .= "</tr>\n";
            $searchList .= "</table>\n";
        }
    //        var_dump($search);die;
        return $search;
    }

}