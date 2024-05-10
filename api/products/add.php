<?php

use Cloudinary\Api\Upload\UploadApi;

session_start();

$imagesData = [];
$upload = new UploadApi();

for ($i = 0; $i < count($_SESSION['images']); $i++) {
    $file_tmp = $_SESSION['images'][$i];
    $tokens = explode('/', $file_tmp);
    $file_id = str_replace("php", "", $tokens[sizeof($tokens) - 1]);

    $res = $upload->upload($file_tmp, [
        'public_id' => $file_id,
        'use_filename' => true,
        'overwrite' => true
    ]);

    $imagesData[] = [
        'src' => $res['secure_url']
    ];

    unlink($file_tmp);
}


$tagsData = array_map(function ($name) {
    return ['name' => $name];
}, $_SESSION["tags"]);
$categoriesData = array_map(function ($id) {
    return ['id' => $id];
}, $_SESSION["categories"]);
$data = [
    'name' => $_SESSION['name'],
    'images' => $imagesData,
    'regular_price' => $_SESSION["regular_price"],
    'sale_price' => $_SESSION["sale_price"],
    'sku' => $_SESSION["sku"],
    'stock_quantity' => $_SESSION['stock_quantity'],
    'backorders' => $_SESSION["backorders"],
    'status' => $_SESSION["status"],
    'description' => $_SESSION["description"],
    'tags' => $tagsData,
    'categories' => $categoriesData
];
$woocommerce->post('products/', $data);
header("Location: http://localhost/fluffybunny/index.php?page=productAll");
session_destroy();
