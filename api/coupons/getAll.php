<?php
$allCoupons = [];
for ($index = 1; ; $index++) {
    $data = $woocommerce->get('coupons', [
        "page" => $index,
        "per_page" => 100
    ]);

    if (!$data) {
        break;
    }

    $allCoupons = array_merge($allCoupons, $data);
}
echo json_encode($allCoupons);
?>