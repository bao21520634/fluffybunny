<?php
use Cloudinary\Api\Upload\UploadApi;

if (isset($_GET["id"])) {

    $upload = new UploadApi();

    session_start();
    for ($i = 0; $i < count($_SESSION["all_images"]); $i++) {
        $upload->destroy(pathinfo($_SESSION["all_images"][$i]['name'], PATHINFO_FILENAME));
    }

    $productID = $_GET["id"];
    $woocommerce->delete('products/' . $productID);
    header("Location: http://localhost/~vgbao2110/fluffybunny/index.php?page=productAll");
    session_destroy();
}
