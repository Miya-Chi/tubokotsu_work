<?php
require_once('db.php');

class DBCustomer extends DB
{
    //customerテーブルのCRUD担当
    public function UpdateCustomer()
    {
        $sql = "UPDATE customer SET CustomerName=?, TEL=?, Email=? WHERE CustomerID=?";
        //array関数の引数の順番に注意すること
        $array = array($_POST['CustomerName'], $_POST['TEL'], $_POST['Email'], $_POST['CustomerID']);
        parent::executeSQL($sql, $array);
    }

    public function CustomerNameForUpdate($CustomerID)
    {
        return $this->FieldValueForUpdate($CustomerID, "CustomerName");
    }

    public function TELForUpdate($CustomerID)
    {
        return $this->FieldValueForUpdate($CustomerID, "TEL");
    }

    public function EmailForUpdate($CustomerID)
    {
        return $this->FieldValueForUpdate($CustomerID, "Email");
    }

    private function FieldValueForUpdate($CustomerID, $field)
    {
        //引数の値を取得
        $sql = "SELECT {$field} FROM customer WHERE CustomerID=?";
        $array = array($CustomerID);
        $res = parent::executeSQL($sql, $array);
        $rows = $res->fetch(PDO::FETCH_NUM);
        return $rows[0];
    }

    public function DeleteCustomer($CustomerID)
    {
        $sql = "DELETE FROM customer WHERE CustomerID=?";
        $array = array($CustomerID);
        parent::executeSQL($sql, $array);
    }

    public function InsertCustomer()
    {
        $sql = "INSERT INTO customer VALUE(?,?,?,?)";
        $array = array($_POST['CustomerID'], $_POST['CustomerName'], $_POST['TEL'], $_POST['Email']);
//
//        $errorMessages = "";
//        if ($_POST['CustomerID'] == null || strcmp($_POST['CustomerID'], "") == 0) {
//            $errorMessages .= "IDの入力は必須です。";
//        }
//        if ($_POST['CustomerName'] == null || strcmp($_POST['CustomerName'], "") == 0) {
//            $errorMessages .= "顧客名の入力は必須です。";
//        }
//        if (!preg_match("/^[0-9]+$/", $_POST['TEL'])) {
//            # 半角数字以外が含まれていた場合、false
//            $errorMessages .= "TELは半角数字で入力してください。";
//        }
//        if (filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
//        } else {
//            # メールアドレスの形式が間違っていたら
//            $errorMessages .= "メールアドレスの形式が正しくありません。";
//        }
//
//
//        if($errorMessages !== "") {
//            return $errorMessages;
//        }

//        配列
        $errorMessages = array("IDの入力は必須です。", "顧客名の入力は必須です。", "TELは半角数字で入力してください。", "メールアドレスの形式が正しくありません。");
        $returnError  =[];

        if ($_POST['CustomerID'] == null || strcmp($_POST['CustomerID'], "") == 0) {
            array_push($returnError, $errorMessages[0]);
        }
        if ($_POST['CustomerName'] == null || strcmp($_POST['CustomerName'], "") == 0) {
            array_push($returnError, $errorMessages[1]);
        }
        if (!preg_match("/^[0-9]+$/", $_POST['TEL'])) {
            # 半角数字以外が含まれていた場合、false
            array_push($returnError, $errorMessages[2]);
        }
        if (filter_var($_POST['Email'], FILTER_VALIDATE_EMAIL)) {
        } else {
            # メールアドレスの形式が間違っていたら
            array_push($returnError, $errorMessages[3]);
        }
        if(!empty($returnError)){
//            var_dump($returnError);die;
            return $returnError;
        }
//        var_dump($sql);die;
        parent:: executeSQL($sql, $array);
    }

    public function SelectCustomerAll()
    {
        $sql = "SELECT * FROM customer";
        $res = parent::executeSQL($sql, null);
        $data = "<table class='recordlist'>";
        $data .= "<tr><th>ID</th><th>顧客名</th><th>TEL</th><th>Email</th><th></th><th></th></tr>\n";
        foreach ($rows = $res->fetchAll(PDO::FETCH_NUM) as $row) {
            $data .= "<tr>";
            for ($i = 0; $i < count($row); $i++) {
                $data .= "<td>{$row[$i]}</td>";
            }
            //更新ボタンのコード
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
      <input type='submit' name='delete' id='delete' value='削除' onClick='return CheckDelete()'>
      </form></td>
eof;
            $data .= "</tr>\n";
        }
        $data .= "</table>\n";
        return $data;
    }
}

