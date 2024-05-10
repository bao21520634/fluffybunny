<?php

$allProducts = [];
for ($index = 1;; $index++) {
    $data = $woocommerce->get('products', [
        "page" => $index,
        "per_page" => 100
    ]);

    if (!$data) {
        break;
    }

    $allProducts = array_merge($allProducts, $data);
}

echo json_encode($allProducts);
