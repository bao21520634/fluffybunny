<?php
$allProducts = [];
for ($index = 1; $index <= 1; $index++) {
    $data = $woocommerce->get('products', [
        "page" => $index,
        "per_page" => 100
    ]);
    if (!$data) {
        break;
    }
    $allProducts = array_merge($allProducts, $data);
};

$count = 0;
$allProducts = json_decode(json_encode(($allProducts)), true);
foreach($allProducts as $product){
    if ($product["stock_quantity"] === 0){
          $data = [
            'backorders_allowed' => true,
            'backorders' => 'notify'
        ];
        $res = $woocommerce->put('products/' . $product['id'], $data);
        if($res) {
            $count++;
        }
    }
}
echo 'Successful add quantities for ' . $count . ' products!';
?>