<?php
$USER= 'root';
$PW= 'admin';
$dnsinfo= "mysql:dbname=salesmanagement;host=mysql;charset=utf8";
try {
	$pdo = new PDO($dnsinfo,$USER,$PW);
	$sql = "UPDATE goods SET Price=? WHERE GoodsID=?";
	$stmt = $pdo->prepare($sql);
	$res = $stmt->execute(array(1080,'1999'));
	if($res){$res="<p>更新しました</p>\n";}
}catch(PDOException $e){
	echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>始めようphp</title>
	<meta charset="utf-8">
	<style>
		table{border-collapse: collapse;}
		td{border: 1px solid black;}
	</style>
</head>
<body>
	<h1>goodsテーブルのレコードを更新する</h1>
	<?php echo $res;?>
</body>
</html>