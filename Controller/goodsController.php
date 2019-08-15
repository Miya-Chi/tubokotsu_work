<?php
require_once('../Model/goodsModel.php');

$dbGoods = new DBGoods02();

Class GoodsList{

    public $Price;
    public function getUpdateGoods()
    {
        global $dbGoods;
        //更新処理
        if (isset($_POST['submitUpdate'])) {
            $dbGoods->setUpdateGoods();
        }

    }


    public function updateGoods()
    {
        global $dbGoods;
        $this->getUpdateGoods();
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
        $array = array($dbGoodsId, $dbGoodsName, $Price, $entryCss, $updateCss);
        return $array;
    }


    public function getDeleteGoods()
    {
     global $dbGoods;
        //削除処理
        if (isset($_POST['delete'])) {
            $dbGoods->setDeleteGoods($_POST['id']);
        }
        return;
    }


    public function validateMessage()
    {
        global $dbGoods;
//        新規登録処理
        if (isset($_POST['submitEntry'])) {
            $errorMessages = $dbGoods->getInsertGoods();
        }
        return $errorMessages;
//        var_dump($errorMessages);die;
    }


    public function getInsertGoods()
    {
        global $dbGoods;
        //テーブルデータの一覧表示
        $data = $dbGoods->getSelectGoods();
        $totalNumber = $dbGoods->getTotalNumber();
        $sorting = $_GET["sort"];

        $forInsert =array($data, $totalNumber, $sorting);
        return $forInsert;
    }

    public function getSearchGoods()
    {
        global $dbGoods;
        //検索
        $search = $dbGoods->SearchGoods($_GET['name']);
        return $search;
    }
}
//新規登録処理

//検索
$search = $dbGoods->SearchGoods($_GET['name']);