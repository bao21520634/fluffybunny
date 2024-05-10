<?php
session_start();
if ($_SESSION["slug"] != '') {
    $data = [
        'name' => $_SESSION["name"],
        'slug' => $_SESSION["slug"],
        'parent' => $_SESSION["parent"],
        'description' => $_SESSION["description"]
    ];
} else {
    $data = [
        'name' => $_SESSION["name"],
        'parent' => $_SESSION["parent"],
        'description' => $_SESSION["description"]
    ];
}
$woocommerce->post('products/categories', $data);
header("Location: http://localhost/fluffybunny/index.php?page=categoryAll");
session_destroy();
?>