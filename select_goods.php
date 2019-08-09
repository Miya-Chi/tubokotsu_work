<?php
$USER= 'root';
$PW= 'admin';
$dnsinfo= "mysql:dbname=salesmanagement;host=mysql;charset=utf8";
try {
	$pdo = new PDO($dnsinfo,$USER,$PW);
	$sql = "SELECT * FROM goods";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(null);
	$res = "";
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		$res .= $row['GoodsID'] ."," .$row['GoodsName'] ."," .$row['Price'] ."<br>\n";
	}
} catch (Exception $e) {
	echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>始めようphp</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>goodsテーブルのレコードを選択する</h1>
	<?php echo $res;?>
</body>
</html>