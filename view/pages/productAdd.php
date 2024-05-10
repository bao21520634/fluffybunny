<section>
    <?php
    session_start();
    $allImages = [];
    if (isset($data["images"])) {
        foreach ($data["images"] as $image) {
            $allImages[] = $image['id'];
        }
    }
    if (isset($_POST["submit"]) && $_POST["submit"] == "Add") {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["regular_price"] = $_POST["regular_price"];
        $_SESSION["sale_price"] = $_POST["sale_price"];
        $_SESSION["sku"] = $_POST["sku"];
        if ($_POST["stock_quantity"] != NULL) {
            $_SESSION["stock_quantity"] = (int) $_POST["stock_quantity"];
        } else {
            $_SESSION["stock_quantity"] = NULL;
        }
        if (isset($_POST["backorders"])) {
            $_SESSION["backorders"] = $_POST["backorders"];
        } else
            $_SESSION["backorders"] = 'no';
        if (isset($_POST["status"])) {
            $_SESSION["status"] = $_POST["status"];
        } else
            $_SESSION["status"] = 'draft';
        $_SESSION["description"] = htmlentities($_POST["editor"]);
        $_SESSION["tags"] = explode(',', trim($_POST["tags"]));
        
        $_SESSION['images'] = $_FILES['images']['tmp_name'];
        for ($i = 0; $i < count($_FILES['images']['tmp_name']); $i++) {
            move_uploaded_file($_FILES['images']['tmp_name'][$i], $_FILES['images']['tmp_name'][$i]);
        }

        $checkedCategories = [];
        if (isset($_POST['category']) && is_array($_POST['category'])) {
            foreach ($_POST['category'] as $checkedCategory) {
                $checkedCategories[] = $checkedCategory;
            }
        }
        $_SESSION['categories'] = $checkedCategories;
        header("Location: http://localhost/~vgbao2110/fluffybunny/api/products/?action=add");
    }
    ?>
    <form action="" method="POST" id="productDetails" enctype="multipart/form-data">
        <table border='0'>
            <tr>
                <td colspan=4>
                    Product name: <br>
                    <input required name="name" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    Regular Price: <br>
                    <input required name="regular_price" min=0 pattern="[^\-]+" type="number">
                </td>
                <td>
                    Sale Price: <br>
                    <input name="sale_price" min=0 pattern="[^\-]+" style="color: red;" type="number">
                </td>
                <td>
                    Stock Quantity: <br>
                    <input name="stock_quantity" min=0 pattern="[^\-]+" type="number">
                </td>
                <td>
                    Tags: <br>
                    <input name="tags" type="text">
                </td>
            </tr>
            <tr>
                <td>Backorder Permission: <br>
                    <select name="backorders">
                        <option id="no" value="no"> No </option>
                        <option id="notify" value="notify"> Yes, but must inform customer </option>
                        <option id="yes" value="yes"> Yes </option>
                    </select>
                </td>
                <td>Post Status: <br>
                    <select name="status">
                        <option id="publish" value="publish"> Publish </option>
                        <option id="pending" value="pending"> Pending </option>
                        <option id="private" value="private"> Private </option>
                        <option id="draft" value="draft"> Draft </option>
                    </select>
                </td>
                <td>SKU: <br>
                    <input required name="sku" type="text">
                </td>
                <td rowspan="2">
                    Categories: <br>
                    <?php
                    $categoryData = file_get_contents('http://localhost/~vgbao2110/fluffybunny/api/categories');
                    $allCategories = json_decode($categoryData, true);
                    foreach ($allCategories as $category) {
                        echo "<input type='checkbox' name='category[]' value='{$category['id']}'>";
                        echo "<label style='margin-left: 10px;'>{$category['name']}</label><br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan=3>
                    Description:
                    <div class="editor-box">
                        <textarea name="editor" id="editor"></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <ul class="product_action_btn">
                        <li style="background-color: blue;">
                            <input type="submit" name="submit" value="Add" style="background-color: blue; border: none; cursor: pointer; color: white">
                        </li>
                    </ul> </td>
            </tr>
            <tr>
                <input type="file" name="images[]" required multiple />
            </tr>
        </table>
    </form>
</section>
<style>
    .ck.ck-editor {
        width: 800px;
    }

    #productDetails {
        width: 100%;
    }

    table {
        width: 100%;
    }

    input[type="text"],
    input[type="number"] {
        width: 100%;
        height: 40px;
    }

    td {
        padding: 10px;
        vertical-align: top;
    }

    .prod-images {
        display: flex;
        flex-wrap: wrap;
        list-style: none;
    }

    .prod-images li {
        width: 23%;
        height: 200px;
        margin-top: 20px;
        margin-right: 20px;
    }

    .prod-images li img {
        width: 100%;
        height: 190px;
    }

    .product_action_btn {
        display: flex;
        list-style: none;
    }

    .product_action_btn li {
        margin-right: 20px;
        width: 80px;
        text-align: center;
        border: 1px solid black;
        padding: 10px;
    }
</style>
<script>
    const inputField = document.querySelector('input[pattern]');
    inputField.addEventListener('onkeypress', () => {
        if (inputField.value.includes('-')) {
            alert('Hyphens are not allowed!');
            inputField.value = inputField.value.replace('-', '');
        }
    });
</script>