<?php
require_once ('config.php');
require_once ('DBGoods.php');
$dbGoods = new DBGoods();
$totalNumber = $dbGoods->getTotalNumber();
$selectGoodsAll = $dbGoods->SelectGoodsAll();

try{
    $pdo = new PDO($dns, $USER, $PW);
    $res = "接続";
} catch(PDOException $e){
    var_dump($e->getMessage());die;
}


//class Paging{
//    public function Pages(){

// 総件数取得


// 商品データ取得
$ssql = "SELECT * FROM goods ORDER BY 'GoodsID' ASC LIMIT 3"; // データ抽出用SQL

// データ抽出用SQLを、プリペアドステートメントで実行
$ssth = $pdo->prepare($ssql);
//$ssth->bindValue(":q", $_get_query);
$ssth->bindValue(":start", $_get_page * 3);
$ssth->execute();
$dataAll = $ssth->fetchAll(PDO::FETCH_ASSOC);

