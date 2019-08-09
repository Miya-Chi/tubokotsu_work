<?php
$USER= 'root';
$PW= 'admin';
$dnsinfo= "mysql:dbname=salesmanagement;host=mysql;charset=utf8";
try {
	$pdo = new PDO($dnsinfo,$USER,$PW);
	$sql = "INSERT INTO goods VALUES('1999','神秘的な鉛筆', 300)";
	$stmt = $pdo->prepare($sql);
	$res = $stmt->execute(null);
} catch (Exception $e) {
	$res = $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>始めようphp</title>
	<meta charset="utf-8">
</head>
<body>
	<h1>goodsテーブルにレコードを追加する</h1>
	<?php if ($res==TRUE) {echo "OK";}
		else if($res==FALSE){echo "NGだよ";}
		else{echo $res;}
	?>
</body>
</html>