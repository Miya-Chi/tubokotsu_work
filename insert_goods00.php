<?php
$res = "";
if(isset($_POST['insert'])){
	$USER= 'root';
	$PW= 'admin';
	$dnsinfo= "mysql:dbname=salesmanagement;host=mysql;charset=utf8";
	try{
		$pdo = new PDO($dnsinfo,$USER,$PW);
		$sql = "INSERT INTO goods VALUES(?,?,?)";
		$stmt = $pdo->prepare($sql);
		$array = array($_POST['GoodsID'],$_POST['GoodsName'],$_POST['Price']);
		$res = $stmt->execute($array);
	}catch(Exception $e){
		$res = $e->getMessage();
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>売上管理システム</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<h1>商品マスタの登録</h1>
	<form action="" method="post">
		<label>GoodsID<input type="text" name="GoodsID" size="20" required></label>
		<label>GoodsName<input type="text" name="GoodsName" size="40" required></label>
		<label>Price<input type="text" name="Price" size="20" required></label>
		<input type="submit" name="insert" value="登録">
	</form>
	<?php echo $res;?>

</body>
</html>