<section>
    <?php
    $id = $_GET["id"];
    $data = file_get_contents("http://localhost/fluffybunny/api/coupons?id=$id");
    $data = json_decode($data, true);

    session_start();
    if (isset($_POST["submit"]) && $_POST["submit"] == "Update") {
        $_SESSION["id"] = $id;
        $_SESSION["code"] = $_POST["code"];
        $_SESSION["amount"] = $_POST["amount"];
        $_SESSION["date_expires"] = $_POST["date_expires"];
        $_SESSION["discount_type"] = $_POST["discount_type"];
        $_SESSION["description"] = $_POST["description"];
        $_SESSION["usage_limit"] = $_POST["usage_limit"];
        $_SESSION["usage_limit_per_user"] = $_POST["usage_limit_per_user"];
        header("Location: http://localhost/fluffybunny/api/coupons/?id=$id&action=update");
    }
    ?>
    <form action="" method="POST">
        <table border='0'>
            <tr>
                <td colspan=4>
                    Coupon code: <br>
                    <input name="code" required type="text" value="<?php echo $data["code"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Amount: <br>
                    <input name="amount" required min=1 pattern="[^\-]+" type="number"
                        value="<?php echo $data["amount"]; ?>">
                </td>
                <td>
                    Date expires: <br>
                    <?php
                    $date = new DateTime($data["date_created"]);
                    $createdDate = $date->format('Y-m-d\TH:i');
                    ?>
                    <input name="date_expires" required min="<?php echo $createdDate  ?>" type="datetime-local"
                        value="<?php echo $data["date_expires"]; ?>">
                </td>
                <td>
                    Usage limit: <br>
                    <input name="usage_limit" required min=1 value="<?php echo $data["usage_limit"]; ?>"
                        pattern="[^\-]+" type="number">
                </td>
                <td>
                    Usage limit per user: <br>
                    <input name="usage_limit_per_user" value="<?php echo $data["usage_limit_per_user"]; ?>" required
                        min=1 pattern="[^\-]+" type="number">
                </td>
            </tr>
            <tr>
                <td colspan=4>
                    Description:
                    <input type="text" name="description" value="<?php echo $data["description"] ?>">
                </td>
            </tr>
            <tr>
                <td>Discount type: <br>
                    <input type="radio" id="percent" value="percent" name="discount_type"> Percent <br>
                    <input type="radio" id="fixed_cart" value="fixed_cart" name="discount_type"> Fixed-cart <br>
                    <input type="radio" id="fixed_product" value="fixed_product" name="discount_type"> Fixed-product
                    <br>
                    <?php
                    $discount_type = $data["discount_type"];
                    if ($discount_type === 'percent') {
                        $discountTypeCheck = 'percent';
                    } else if ($discount_type === 'fixed_cart') {
                        $discountTypeCheck = 'fixed_cart';
                    } else if ($discount_type === 'fixed_product') {
                        $discountTypeCheck = 'fixed_product';
                    }
                    $discountTypeCheckingScript = <<<JAVASCRIPT
                    <script>
                    document.getElementById('$discountTypeCheck').checked = true;
                    </script>
                    JAVASCRIPT;
                    echo $discountTypeCheckingScript;
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="coupon_action_btn">
                        <li>
                            <a href="http://localhost/fluffybunny/api/coupons?id=<?php echo $data['id'] ?>&action=delete"
                                id="deleteCoupon">Delete</a>
                        </li>
                        <li style="background-color: blue;">
                            <input type="submit" name="submit" value="Update"
                                style="background-color: blue; border: none; cursor: pointer; color: white">
                        </li>
                </td>
            </tr>
        </table>
    </form>
</section>
<style>
table {
    width: 100%;
}

input[type="text"],
input[type="datetime-local"],
input[type="number"] {
    width: 100%;
    height: 40px;
}

td {
    padding: 10px;
    vertical-align: top;
}

.coupon_action_btn {
    display: flex;
    list-style: none;
}

.coupon_action_btn li {
    margin-right: 30px;
    width: 120px;
    text-align: center;
    border: 1px solid black;
    padding: 10px;
}
</style>
<script>
const inputField = document.querySelector('input[pattern]');
inputField.addEventListener('input', () => {
    if (inputField.value.includes('-')) {
        alert('Hyphens are not allowed!');
        inputField.value = inputField.value.replace('-', '');
    }
});
</script>