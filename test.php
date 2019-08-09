<?php 
$msg = "<p>ぼくはカエルです</p>\n";
$msg .= "<p>よろしくね！</p>\n";
$age = 10;
$age = "<p>ぼくは{$age}才なんだよ</p>\n";
$mission = <<<eof
<h2>学習内容</h2>
<ul>
	<li>PHP</li>
	<li>MySOL</li>
</ul>
eof;
?>

<!DOCTYPE html>
<html>
<head>
	<title>始めようphp</title>
<meta charset="utf-8">
</head>
<body>
<h1>PHPの基本</h1>
<?php echo $msg;?>
<p>PHPを覚えるぞ</p>
<?php
	echo $age;
	echo $umission;

 ?>
</body>
</html>