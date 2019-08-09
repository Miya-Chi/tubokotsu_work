<?php
$USER= 'root';
$PW= 'admin';
$dnsinfo= "mysql:dbname=salesmanagement;host=mysql;charset=utf8";
try{
	$pdo = new PDO($dnsinfo,$USER,$PW);
	$res = "接続しました";
}catch(PDOException $e){
	$res = $e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>始めようphp</title>
</head>
<body>
<h1>PHPでMySQLに接続する</h1>
<?php echo $res;?>
</body>
</html>