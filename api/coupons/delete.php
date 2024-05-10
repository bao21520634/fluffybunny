<?php
if (isset($_GET["id"])) {
    $couponID = $_GET["id"];
    $woocommerce->delete('coupons/' . $couponID);
    header("Location: http://localhost/fluffybunny/index.php?page=couponAll");
}
?>