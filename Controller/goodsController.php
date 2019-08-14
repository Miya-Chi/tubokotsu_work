<?php
require_once('../Model/goodsModel.php');

$dbGoods = new DBGoods02();

//更新処理
if (isset($_POST['submitUpdate'])) {
    $dbGoods->UpdateGoods();
}
//更新用フォーム要素の表示
if (isset($_POST['update'])) {
    //更新対象の値を取得
    $dbGoodsId = $_POST['id'];
    $dbGoodsName = $dbGoods->GoodsNameForUpdate($_POST['id']);
    $Price = $dbGoods->PriceForUpdate($_POST['id']);
    //クラスを記述することで表示/非表示を設定
    $entryCss = "class='hideArea'";
    $updateCss = "";
} else {
    $entryCss = "";
    $updateCss = "class='hideArea'";
}
//削除処理
if (isset($_POST['delete'])) {
    $dbGoods->getDeleteGoods($_POST['id']);
}
//新規登録処理
if (isset($_POST['submitEntry'])) {
    $errorMessages = $dbGoods->showErrorMessages();
}
//テーブルデータの一覧表示
$data = $dbGoods->getSelectGoods();
$totalNumber = $dbGoods->getTotalNumber();
$sorting = $_GET["sort"];

//検索
$search = $dbGoods->SearchGoods($_GET['name']);