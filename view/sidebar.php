<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <div id="sidebar">
        <div class="sidebar-header">
            <h3>Fluffy Bunny API</h3>
        </div>

        <ul class="list-unstyled components">
            <p>Menu</p>
            <li>
                <a href="index.php">Dashboard</a>
            </li>
            <li>
                <a href="#productsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Product</a>
                <ul class="collapse list-unstyled" id="productsSubmenu">
                    <li>
                        <a href="index.php?page=productAll">List all products</a>
                    </li>
                    <li>
                        <a href="index.php?page=productAdd">Add a product</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#categoriesSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Category</a>
                <ul class="collapse list-unstyled" id="categoriesSubmenu">
                    <li>
                        <a href="index.php?page=categoryAll">List all categories</a>
                    </li>
                    <li>
                        <a href="index.php?page=categoryAdd">Add a category</a>
                    </li>
                    </ul>
            </li>
            <li>
                <a href="#couponsSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Coupon</a>
                <ul class="collapse list-unstyled" id="couponsSubmenu">
                    <li>
                        <a href="index.php?page=couponAll">List all coupons</a>
                    </li>
                    <li>
                        <a href="index.php?page=couponCreate">Create a coupon</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</body>
</html>
