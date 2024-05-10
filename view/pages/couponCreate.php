<section>
    <?php
    session_start();
    if (isset($_POST["submit"]) && $_POST["submit"] == "Create") {
        $_SESSION["code"] = $_POST["code"];
        $_SESSION["amount"] = $_POST["amount"];
        $_SESSION["date_expires"] = $_POST["date_expires"];
        $_SESSION["discount_type"] = $_POST["discount_type"];
        $_SESSION["description"] = $_POST["description"];
        $_SESSION["usage_limit"] = $_POST["usage_limit"];
        $_SESSION["usage_limit_per_user"] = $_POST["usage_limit_per_user"];  
        header("Location: http://localhost/fluffybunny/api/coupons/?action=create");
    }
    ?>
    <form action="" method="POST">
        <table border='0'>
            <tr>
                <td colspan=4>
                    Coupon code: <br>
                    <input name="code" required id="code" type="text" style='width: 100%'>
                    <br>
                    Random:
                    <i class="fas fa-random    " onclick="generateCoupon()" style='cursor: pointer;'></i>
                </td>
            </tr>
            <tr>
                <td>
                    Amount: <br>
                    <input name="amount" required min=1 pattern="[^\-]+" type="number">
                </td>
                <td>
                    Usage limit: <br>
                    <input name="usage_limit" required min=1 pattern="[^\-]+" type="number">
                </td>
                <td>
                    Usage limit per user: <br>
                    <input name="usage_limit_per_user" required min=1 pattern="[^\-]+" type="number">
                </td>
                <td>
                    Date expires: <br>
                    <?php
                    $now = date('Y-m-d\TH:i');
                    ?>

                    <input name="date_expires" min="<?php echo $now; ?>" required type="datetime-local">
                </td>
            </tr>
            <tr>
                <td colspan=4>
                    Description:
                    <input type="text" name="description">
                </td>
            </tr>
            <tr>
                <td>Discount type: <br>
                    <select name="discount_type">
                        <option id="fixed_cart" value="fixed_cart" name="discount_type"> Fixed-cart <br>
                        <option id="percent" value="percent" name="discount_type"> Percent <br>
                        <option id="fixed_product" value="fixed_product" name="discount_type"> Fixed-product
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="coupon_action_btn">
                        <li style="background-color: blue;">
                            <input type="submit" name="submit" value="Create"
                                style="background-color: blue; border: none; cursor: pointer; color: white">
                        </li>
                    </ul>
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

    function generateCoupon() {
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const couponLength = 20;
        let coupon = '';

        for (let i = 0; i < couponLength; i++) {
            const randomIndex = Math.floor(Math.random() * characters.length);
            coupon += characters[randomIndex];
        }

        document.getElementById('code').value = coupon;
    }
</script>