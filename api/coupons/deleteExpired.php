<?php
$allCoupons = [];
for ($index = 1; $index <= 1; $index++) {
    $data = $woocommerce->get('coupons', [
        "page" => $index,
        "per_page" => 100
    ]);

    if (!$data) {
        break;
    }
    $allCoupons = array_merge($allCoupons, $data);
}
$allCoupons = json_decode(json_encode(($allCoupons)), true);
$deleteCoupons = [];

foreach ($allCoupons as $coupon) {
    $diffInSeconds = date_create($coupon["date_expires"])->getTimestamp() - date_create()->getTimestamp();
    if ($diffInSeconds < 0) {
        $deleteCoupons[] = $coupon["id"];
    }
}
$woocommerce->post('coupons/batch', [
    'delete' => $deleteCoupons
]);

echo "Expired coupons have been successfully deleted";
