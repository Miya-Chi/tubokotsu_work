<?php 
$res = "";
if(isset($_POST['submit'])){
	$res = JudgeEvenOdd($_POST['num']);
}

function JudgeEvenOdd($num){
	if($num % 2 == 1){
		return "奇数です";
	}else{
		return "偶数です";
	}
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

