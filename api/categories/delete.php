<?php
if (isset($_GET["id"])) {
    $categoryID = $_GET["id"];
    $woocommerce->delete('products/categories/' . $categoryID, ['force' => true]);
    header("Location: http://localhost/~vgbao2110/fluffybunny/index.php?page=categoryAll
    ");
}
?>