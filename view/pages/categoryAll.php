<!DOCTYPE html>
<html>

<head>
    <title>All categories</title>
    <meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">
</head>

<body>

    <?php
    $data = file_get_contents('http://localhost/fluffybunny/api/categories');
    $data = json_decode($data, true);
    ?>
    <div>
        <br><br>
        <center>
            <h3>Fluffy Bunny Categories</h3>
        </center>
        <br><br>
    </div>
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th style="width: 30%;">Name</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Parent ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td>
                                <?php
                                    echo "<a href='index.php?page=categoryDetails&id=$row[id]'>$row[name]</a>";
                                ?>
                            </td>
                            <td>
                                <?= $row['slug']; ?>
                            </td>
                            <td>
                                <?= $row['description']; ?>
                            </td>
                            <td>
                                <?= $row['parent']; ?>
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

    a:hover {
        color: blue;
    }
</style>