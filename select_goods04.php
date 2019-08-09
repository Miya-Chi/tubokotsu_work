<?php 
$res = "";
if(isset($_POST['select'])){
	$USER= 'root';
	$PW= 'admin';
	$dnsinfo= "mysql:dbname=salesmanagement;host=mysql;charset=utf8";
	try{
		$pdo = new PDO($dnsinfo,$USER,$PW);
		$sql = "SELECT * FROM goods WHERE GoodsID=?";
		$stmt = $pdo->prepare($sql);
		$array = array($_POST['GoodsID']);
		$stmt->execute($array);
		$res = "<table>\n";
		while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
			$res .= "<tr><td>" .$row['GoodsID'] ."</td><td>" .$row['GoodsName'] ."</td></tr>\n";
		}
		$res .= "</table>\n";
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
	<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
	<h1>商品マスタの選択</h1>
	<form action="" method="post">
		<label>GoodsID<input type="text" name="GoodsID" size="20" required></label>
		<input type="submit" name="select" value="表示">
	</form>
<?php echo $res;?>
</body>
</html>