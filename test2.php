<?php
print_r($_POST);
$name = "";
if(isset($_POST['exe'])){
$name = $_POST['username'];
$name = "<p>{$name}さんですね。</p>\n";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>始めようphp</title>
<meta charset="utf-8">
</head>
<body>
<h1>動的なWebページの作成</h1>
<form method="post" action="">
	<label>名前<input type="text" name="username" required></label>
	<input type="submit" name="exe" value="実行">
</form>
<?php echo $name;?>
</body>
</html>