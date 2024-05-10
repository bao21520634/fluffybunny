<?php

use Cloudinary\Api\Upload\UploadApi;

$upload = new UploadApi();

session_start();

for ($i = 0; $i < count($_SESSION["delete_images"]); $i++) {
    for ($j = 0; $j < count($_SESSION["all_images"]); $j++) {
        if ((string)$_SESSION["all_images"][$j]['id'] === $_SESSION["delete_images"][$i]) {
            $upload->destroy(pathinfo($_SESSION["all_images"][$j]['name'], PATHINFO_FILENAME));
            break;
        }
    }
}

$imagesData = array_map(function ($id) {
    return ['id' => $id];
}, $_SESSION["images"]);

echo "<script>console.log('Debug Objects 1: " . json_encode($_SESSION['add_images']) . "' );</script>";
if (count($_SESSION['add_images']) > 0) {
    for ($i = 0; $i < count($_SESSION['add_images']); $i++) {
        if ($_SESSION['add_images'][$i]) {
            $file_tmp = $_SESSION['add_images'][$i];
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
    
        }
        unlink($file_tmp);
    }
}

$tagsData = array_map(function ($name) {
    return ['name' => $name];
}, $_SESSION["tags"]);
$categoriesData = array_map(function ($id) {
    return ['id' => $id];
}, $_SESSION["categories"]);

$data = [
    'name' => $_SESSION['name'],
    'slug' => $_SESSION["slug"],
    'regular_price' => $_SESSION["regular_price"],
    'sale_price'  => $_SESSION["sale_price"],
    'stock_quantity' => $_SESSION['stock_quantity'],
    'backorders' => $_SESSION["backorders"],
    'status' => $_SESSION["status"],
    'sku' => $_SESSION["sku"],
    'description' => $_SESSION["description"],
    'images' => $imagesData,
    'tags' => $tagsData,
    'categories' => $categoriesData
];
$woocommerce->put('products/' . $_SESSION["id"], $data);
header("Location: http://localhost/~vgbao2110/fluffybunny/index.php?page=productDetails&id=$_SESSION[id]");
session_destroy();
