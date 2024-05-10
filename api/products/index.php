<?php
require dirname(dirname(__DIR__)) . '/vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Automattic\WooCommerce\Client;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$woocommerce = new Client(
    $_ENV['WP_URL'],
    $_ENV['WP_CK'],
    $_ENV['WP_CS'],
    [
        'wp_api' => true,
        'version' => 'wc/v3',
        'timeout' => 400,
        'query_string_auth' => true // Force Basic Authentication as query string true and using under HTTPS
    ]
);


Configuration::instance([
    'cloud' => [
        'cloud_name' => $_ENV['CLOUDINARY_NAME'],
        'api_key' => $_ENV['CLOUDINARY_KEY'],
        'api_secret' => $_ENV['CLOUDINARY_SECRET']
    ],
    'url' => [
        'secure' => true
    ]
]);

if (isset($_GET['action'])) {
    if (isset($_GET["id"])) {
        if ($_GET["action"] === 'update') {
            include ("./update.php");
        } else if ($_GET["action"] === "delete") {
            include ("./delete.php");
        }
    } else
        include ("./add.php");
} else {
    if (isset($_GET["id"])) {
        include ("./get.php");
    } else
        include ("./getAll.php");
}
?>