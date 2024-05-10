<div class="main">
    <?php
    if (isset($_GET["page"])) {
        $temp = $_GET["page"];
    } else {
        $temp = '';
    }
    if ($temp == '') {
        include ("./view/pages/dashboard.php");
    } else {
        if ($temp == 'productAll') {
            include ("./view/pages/productAll.php");
        }
        if ($temp == 'productAdd') {
            include ("./view/pages/productAdd.php");
        }
        if ($temp == 'productDetails') {
            include ("./view/pages/productDetails.php");
        }
        if ($temp == 'categoryAll') {
            include ("./view/pages/categoryAll.php");
        }
        if ($temp == 'categoryDetails') {
            include ("./view/pages/categoryDetails.php");
        }
        if ($temp == 'categoryAdd') {
            include ("./view/pages/categoryAdd.php");
        }
        if ($temp == 'couponAll'){    
            include ("./view/pages/couponAll.php");
        }
        if ($temp == 'couponDetails') {
            include ("./view/pages/couponDetails.php");
        }
        if ($temp == 'couponCreate') {
            include ("./view/pages/couponCreate.php");
        }
    }
    ?>
</div>