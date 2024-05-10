<?php
$id = $_GET["id"];
$data = $woocommerce->get('coupons/' . $id);
echo json_encode($data);
?>