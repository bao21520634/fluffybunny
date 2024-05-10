<?php

$id = $_GET["id"];
$data = $woocommerce->get('products/categories/' . $id);
echo json_encode($data);
?>