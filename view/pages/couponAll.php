<!DOCTYPE html>
<html>

<head>
    <title>All coupon</title>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
</head>

<body>

    <?php
    $data = file_get_contents('http://localhost/fluffybunny/api/coupons');
    $data = json_decode($data, true);
    ?>
    <div>
        <br><br>
        <center>
            <h3>Fluffy Bunny Coupons</h3>
        </center>
        <br><br>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Coupon code</th>
                        <th>Amount</th>
                        <th>Day expires</th>
                        <th>Discount type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <a href="index.php?page=couponDetails&id=<?= $row['id']; ?>"><?= $row['code']; ?></a>
                            </td>
                            <td>
                                <?= $row['amount']; ?>
                            </td>

                            <td>
                                <?= $row['date_expires']; ?>
                            </td>
                            <td>
                                <?= $row['discount_type']; ?>
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
    .fa-eye:hover {
        cursor: pointer;
    }
    a:hover{
        color: blue;
    }
</style>