<?php
session_start();
$data = [
    'code' => $_SESSION["code"],
    'amount' => $_SESSION["amount"],
    'date_expires' => $_SESSION["date_expires"],
    'discount_type' => $_SESSION["discount_type"],
    'description' => $_SESSION["description"],
    'usage_limit_per_user' => $_SESSION["usage_limit_per_user"],
    'usage_limit' => $_SESSION["usage_limit"]
];
$woocommerce->post('coupons', $data);
header("Location: http://localhost/fluffybunny/index.php?page=couponAll");
session_destroy();
?>