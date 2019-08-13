<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>売上管理システム</title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
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
<div id="entry" <?php echo $entryCss; ?>>
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
    if (!empty($errorMessages)) {

        foreach ($errorMessages as $errorMessage) {
            echo $errorMessage;
        }
    }
    ?>
</div>
<div id="update" <?php echo $updateCss; ?>>
    <form action="" method="post">
        <h2>更新</h2>
        <p>GoodsID: <?php echo $dbGoodsId; ?></p>
        <input type="hidden" name="GoodsID" value="<?php echo $dbGoodsId; ?>"/>
        <label><span class="entrylabel">商品名</span><input type='text' name='GoodsName'
                                                         size="30" value="<?php echo $dbGoodsName; ?>" required></label>
        <label><span class="entrylabel">単価</span><input type='text' name='Price'
                                                        size="10" value="<?php echo $Price; ?>" required></label>
        <input type='submit' name='submitUpdate' value=' 　更新　 '>
    </form>
</div>
<div style="color: red;">
</div>
<div>
    <!-- Total number of goods -->
    <h4>Total: <?php echo $totalNumber; ?></h4>

    <!-- Goods table -->
    <?php
    echo $data;
    ?>
    <br>

    <!-- Paging -->
    <?php
    $pages = ceil($totalNumber / 5); // 総件数÷1ページに表示する件数 を切り上げたものが総ページ数
    for ($i = 1; $i <= $pages; $i++) {
        printf("<a href='/tubokotsu/sales02/goods.php?sort=$sorting&page=%d'>%dページへ</a><br />\n", $i, $i);
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
        <?php echo $search;
        //        foreach ($search as $item){
        //            var_dump($item['GoodsID']);
        //        }
        //        var_dump($search);?>
    </div>
</div>
</body>
</html>