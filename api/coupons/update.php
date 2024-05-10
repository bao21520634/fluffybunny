<?php
session_start();
$data = [
    'code' => $_SESSION["code"],
    'amount' => $_SESSION["amount"],
    'date_expires' => $_SESSION["date_expires"],
    'discount_type' => $_SESSION["discount_type"],
    'description' => $_SESSION["description"],
    'usage_limit' => $_SESSION["usage_limit"],
    'usage_limit_per_user' => $_SESSION["usage_limit_per_user"]
];
$woocommerce->put('coupons/' . $_SESSION["id"], $data);
header("Location: http://localhost/fluffybunny/index.php?page=couponDetails&id=$_SESSION[id]");
session_destroy();
?>