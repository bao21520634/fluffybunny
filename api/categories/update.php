<?php
session_start();
$data = [
    'name' => $_SESSION['name'],
    'slug' => $_SESSION["slug"],
    'parent' => $_SESSION["parent"],

];
$woocommerce->put('products/categories/' . $_SESSION["id"], $data);
header("Location: http://localhost/fluffybunny/index.php?page=categoryDetails&id=$_SESSION[id]");
session_destroy();
?>