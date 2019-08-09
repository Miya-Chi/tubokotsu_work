<?php require_once('EvenOdd.php');
$res = "";
if(isset($_POST['submit'])){
	$evenOdd = new EvenOdd();
	$res = $evenOdd->JudgeEvenOdd($_POST['num']);
}
 ?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>はじめてのクラス</title>
</head>
<body>
<h1>Classの確認</h1>
<form method="post" action="">
	<label>数字を入力<input type="text" name="num" required></label>
	<input type="submit" value=" 判定 " name="submit" />
</form>
<?php echo $res; ?>
</body>
 </html>