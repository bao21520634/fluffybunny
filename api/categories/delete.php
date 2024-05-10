<?php
if (isset($_GET["id"])) {
    $categoryID = $_GET["id"];
    $woocommerce->delete('products/categories/' . $categoryID, ['force' => true]);
    header("Location: http://localhost/fluffybunny/index.php?page=categoryAll
    ");
}
?>