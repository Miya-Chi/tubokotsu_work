<?php
//require_once ('config.php');
//
//$error ='入力された値が不正です。';
//$error2 = 'メールアドレス又はパスワードが間違っています。';
////POSTのvalidate
//if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
////    echo $error;
//    return false;
//}
////DB内でPOSTされたメールアドレスを検索
//try {
//    $pdo = new PDO($dns, $USER, $PW);
//    $stmt = $pdo->prepare('SELECT * FROM user WHERE Email = root@fullspeed.co.jp');
//    $stmt->execute([$_POST['email']]);
//    $row = $stmt->fetch(PDO::FETCH_ASSOC);
//} catch (\Exception $e) {
//    echo $e->getMessage() . PHP_EOL;
//}
////emailがDB内に存在しているか確認
//if (!isset($row['email'])) {
//    echo $error2;
//    return false;
//}
////パスワード確認後sessionにメールアドレスを渡す
//if (password_verify($_POST['password'], $row['password'])) {
//    session_regenerate_id(true); //session_idを新しく生成し、置き換える
//    $_SESSION['email'] = $row['email'];
//    echo 'ログインしました';
////    var_dump();
//} else {
//    echo $error2;
//    return false;
//}

define('DB_HOST', 'mysql');
define('DB_NAME', 'salesmanagement');
define('DB_USER', 'root');
define('DB_PASS', 'admin');
// ログイン処理
function login($email, $password){
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    $db->query('SET NAMES utf8');
    $sql = 'SELECT *  FROM user  WHERE Email = :email AND  PW = :password';
    $stt = $db->prepare($sql);
    $stt->bindParam(':email', $email);
    $stt->bindParam(':password', $password);
    $stt->execute();
    while($row=$stt->fetch()){
        $result['email'] = $row['email'];
        $result['password'] = $row['password'];
    }
    if(isset($result)){
        return $result;
    }
}
// ログイン認証
function authCheck($email, $password){
    $db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
    $db->query('SET NAMES utf8');
    $sql = "SELECT * FROM user WHERE Email = :email AND PW = :password ";
    $stt = $db->prepare($sql);
    $stt->bindParam(':email', $email);
    $stt->bindParam(':password', $password);
    $stt->execute();
    while($row=$stt->fetch()){
        $result['email'] = $row['email'];
        $result['password'] = $row['password'];
    }
    if(isset($result)){
        return $result;
    }
}
