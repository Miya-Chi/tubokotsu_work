<?php
require_once ('../Model/goodsModel.php');
require_once('../Controller/goodsController.php');

$goodsList = new GoodsController();

// 更新ボタンが押された場合
if (isset($_POST['update'])) {
    $forUpdate = $goodsList->updateGoods();
}

$insert = $goodsList->getInsertGoods();
$search = $goodsList->getSearchGoods();

$errorMsgs = $goodsList->validateMessage();
//var_dump($errorMsgs);die;
$goodsList->getDeleteGoods();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>売上管理システム</title>
    <link rel="stylesheet" type="text/css" href="../sales02/style.css"/>
    <script type="text/javascript">
        function CheckDelete() {
            return confirm("削除してもよろしいですか？");
        }
    </script>
</head>
<body>
<div id="menu">
    <ul>
        <li><a href="salesinfo.php">売上情報</a></li>
        <li><a href="salesinfoEntry.php">伝票の新規作成</a></li>
        <li><a href="bill.php">請求書</a></li>
        <li><a href="customer.php">顧客マスタ</a></li>
        <li><a href="goods.php">商品マスタ</a></li>
    </ul>
</div>
<h1>商品マスター</h1>
<div id="entry" <?php echo $forUpdate[3]; ?>>
    <form action="" method="post">
        <h2>新規登録</h2>
        <label><span class="entrylabel">ID</span><input type='text' name='GoodsID' size="10"></label>
        <label><span class="entrylabel">商品名</span><input type='text' name='GoodsName' size="30"></label>
        <label><span class="entrylabel">単価</span><input type='text' name='Price' size="10"></label>
        <input type='submit' name='submitEntry' value=' 　新規登録　 '>
    </form>
</div>
<div style="color: red;">
    <?php
    if (!empty($errorMsgs))
    {
        $m = "";
        foreach ($errorMsgs as $errorMsg) {
            $m = $m.$errorMsg;
        }
        echo $m;
    }
    ?>
</div>
<div id="update" <?php echo $forUpdate[4];
//var_dump($forUpdate[3]);die;
?>>
    <form action="" method="post">
        <h2>更新</h2>
        <p>GoodsID: <?php echo $forUpdate[0]; ?></p>
        <input type="hidden" name="GoodsID" value="<?php echo $forUpdate[2]; ?>"/>
        <label><span class="entrylabel">商品名</span><input type='text' name='GoodsName'
                                                         size="30" value="<?php echo $forUpdate[1]; ?>" required></label>
        <label><span class="entrylabel">単価</span><input type='text' name='Price'
                                                        size="10" value="<?php echo $forUpdate[2]; ?>" required></label>
        <input type='submit' name='submitUpdate' value=' 　更新　 '>
    </form>
</div>
<div style="color: red;">
</div>
<div>
    <!-- Total number of goods -->
    <h4>Total: <?php echo $insert[1]; ?></h4>

    <!-- Goods table -->
    <?php
    echo $insert[0];
//    var_dump($data);die;
    ?>
    <br>

    <!-- Paging -->
    <?php
    $pages = ceil($insert[1] / 5); // 総件数÷1ページに表示する件数 を切り上げたものが総ページ数
    for ($i = 1; $i <= $pages; $i++) {
        printf("<a href='/tubokotsu/View/goodsView.php?sort=$insert[2]&page=%d'>%dページへ</a><br />\n", $i, $i);
    }
    ?>
    <br>

    <!-- Search for Goods -->
    <div>
        <form method="get">
            <label for="name">商品名検索</label>
            <input name="name" value="<?php echo isset($_GET['name']) ? htmlspecialchars($_GET['name']) : '' ?>" >
            <button type="submit" name="search">検索</button>
        </form>
        <?php echo $search; ?>
    </div>
</div>
</body>
</html>