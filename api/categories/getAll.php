<?php

$allCategories = [];
for ($index = 1; ; $index++) {
    $data = $woocommerce->get('products/categories', [
        "page" => $index,
        "per_page" => 100
    ]);
    if (!$data) {
        break;
    }

    $allCategories = array_merge($allCategories, $data);
}

echo json_encode($allCategories);
?>