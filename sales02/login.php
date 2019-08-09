<?php
require_once('config.php');

try{
    $pdo = new PDO($dns, $USER, $PW);
    $res = "接続";
} catch(PDOException $e){
    $res = $e->getMessage();
}
$success = 'ログイン中';
session_start();
require_once('./database.php'); // データベースアクセスファイル読み込み
require_once('./auth.php'); // ログイン認証ファイル読み込み
$errorMessage = ""; // エラーメッセージ初期化
// ログイン処理
if ($_POST['mode']=="login") {
    if(!empty($_POST['form']['email']) && !empty($_POST['form']['password'])){
        if ($account=login($_POST['form']['email'], $_POST['form']['password'])){
            $_SESSION['account'] = $account;
//            echo $success;
            header("Location: ./goods.php");
            exit();
            // ログイン失敗時の表示
        } else {
            $errorMessage = "ログインに失敗しました。";
        }
    } else {
        $errorMessage = "メールアドレスとパスワードを入力してください。";
    }
}
?>
<?php
$login = "";
if($login){ ?>
    echo "ログインしました。";
<?php } else { ?>
    <?php echo $errorMessage; ?>
    <form action="" method="post">

        <input type="text" name="form[email]" value="" placeholder="メールアドレスを入力して下さい。">
        <input type="password" name="form[password]" value="" placeholder="パスワードを入力して下さい。">
        <input type="hidden" name="mode" value="login">
        <input type="submit" name="login" value="ログイン">
    </form>
<?php } ?>

<?php
//
////②
//function h($s){
//return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
//}
//
//session_start();
////ログイン済みの場合
//if (isset($_SESSION['username'])) {
//echo 'ようこそ' .  h($_SESSION['EMAIL']) . "さん<br>";
////echo "<a href='/logout.php'>ログアウトはこちら。</a>";
//exit;
//}
//
//
//session_start();
//$_SESSION["email"] = $_POST["username"];
//$_SESSION["pass"] = $_POST["pass"];
//
//if($_SESSION["email"] != "root@fullspeed.co.jp" || $_SESSION["pass"] != "fullspeed"){
//    ?>
<!--    ログインに失敗しました。<br />-->
<!--    <a href="auth.php">セッション生成ページ</a>-->
<!--    --><?php
//    exit;
//}
//if(isset($_POST["email"])) setcookie("email", $_POST["pass"], time()+120);
//?>
<!--会員専用画面です。<br />-->
<!--ログイン認証に成功しました。現在ログインしている状態です。<br />-->
<!--<a href="login.php">マイページへ</a>-->
<!---->
<!---->
<!--<!DOCTYPE html>-->
<!--<html lang="ja">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <title>Login</title>-->
<!--</head>-->
<!--<body>-->
<!--<h1>ようこそ、ログインしてください。</h1>-->
<!--<form  action="auth.php" method="post">-->
<!--    <label for="email">email</label>-->
<!--    <input type="email" name="Email">-->
<!--    <label for="password">password</label>-->
<!--    <input type="password" name="PW">-->
<!--    <button type="submit">Sign In!</button>-->
<!--</form>-->
<?php ////echo $error2 ?>
<!--</body>-->
<!--</html>-->
<!---->
