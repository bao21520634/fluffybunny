<?php

$id = $_GET["id"];
$data = $woocommerce->get('products/' . $id);
echo json_encode($data);
?>