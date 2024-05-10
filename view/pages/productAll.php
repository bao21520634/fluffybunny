<!DOCTYPE html>
<html>

<head>
    <title>All product</title>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
</head>

<body>

    <?php
    $data = file_get_contents('http://localhost/fluffybunny/api/products');
    $data = json_decode($data, true);
    ?>
    <div>
        <br><br>
        <center>
            <h3>Fluffy Bunny Products</h3>
        </center>
        <br><br>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style = "width: 30%;">Name</th>
                        <th>SKU</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Created date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <a href="index.php?page=productDetails&id=<?= $row['id']; ?>"><?= $row['name']; ?></a>
                            </td>
                            <td>
                                <?= $row['sku']; ?>
                            </td>
                            <td>
                                <?= $row['price']; ?>
                            </td>
                            <td>
                                <img style = "width: 100px; height: 100px;" src="<?= $row['images'][0]['src']; ?>" alt="">
                            </td>
                            <td>
                                <?= $row['date_created']; ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>
<style>
    a:hover{
        color: blue;
    }
</style>