<section>
    <?php
    session_start();
    $id = $_GET["id"];
    $data = file_get_contents("http://localhost/fluffybunny/api/products?id=$id");
    $data = json_decode($data, true);
    $allImages = [];
    if (isset($data["images"])) {
        foreach ($data["images"] as $image) {
            $allImages[] = $image['id'];
        }
    }

    $_SESSION["all_images"] = $data["images"];

    if (isset($_POST["submit"]) && $_POST["submit"] == "Update") {
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["slug"] = $_POST["slug"];
        $_SESSION["regular_price"] = $_POST["regular_price"];
        $_SESSION["sale_price"] = $_POST["sale_price"];
        if ($_POST["stock_quantity"] != NULL) {
            $_SESSION["stock_quantity"] = (int) $_POST["stock_quantity"];
        } else {
            $_SESSION["stock_quantity"] = NULL;
        }
        $_SESSION["backorders"] = $_POST["backorders"];
        $_SESSION["status"] = $_POST["status"];
        $_SESSION["sku"] = $_POST["sku"];
        $_SESSION["description"] = htmlentities($_POST["editor"]);
        $_SESSION["tags"] = explode(',', trim($_POST["tags"]));

        $checkedImages = [];
        if (isset($_POST['image']) && is_array($_POST['image'])) {
            foreach ($_POST['image'] as $checkedImg) {
                $checkedImages[] = $checkedImg;
            }
        }
        $uncheckedImages = array_values(array_diff($allImages, $checkedImages));
        $_SESSION['images'] = $uncheckedImages;
        $_SESSION['delete_images'] = $checkedImages;
        if (count($_FILES['add_images']['tmp_name']) > 0) {
            $_SESSION['add_images'] = $_FILES['add_images']['tmp_name'];
            for ($i = 0; $i < count($_FILES['add_images']['tmp_name']); $i++) {
                move_uploaded_file($_FILES['add_images']['tmp_name'][$i], $_FILES['add_images']['tmp_name'][$i]);
            }
        }

        $checkedCategories = [];
        if (isset($_POST['category']) && is_array($_POST['category'])) {
            foreach ($_POST['category'] as $checkedCategory) {
                $checkedCategories[] = $checkedCategory;
            }
        }
        $_SESSION['categories'] = $checkedCategories;

        header("Location: http://localhost/fluffybunny/api/products/?id=$id&action=update");
    }
    ?>
    <form action="" method="POST" id="productDetails" enctype="multipart/form-data">
        <table border='0'>
            <tr>
                <td colspan=4>
                    Product name: <br>
                    <input required name="name" type="text" value="<?php echo $data["name"]; ?>">
                </td>
            </tr>
            <tr>
                <td colspan=4>
                    Slug: <br>
                    <input name="slug" style="color: blue;" type="text" value="<?php echo $data["slug"]; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    Regular Price: <br>
                    <input required name="regular_price" min=0 pattern="[^\-]+" type="number" value="<?php echo $data["regular_price"]; ?>">
                </td>
                <td>
                    Sale Price: <br>
                    <input name="sale_price" min=0 pattern="[^\-]+" style="color: red;" type="number" value="<?php echo $data["sale_price"]; ?>">
                </td>
                <td>
                    Stock Quantity: <br>
                    <input name="stock_quantity" min=0 pattern="[^\-]+" type="number" value="<?php echo $data["stock_quantity"]; ?>">
                </td>
                <td>
                    Tags: <br>
                    <input name="tags" type="text" value="<?php
                                                            $cnt = count($data["tags"]);
                                                            for ($i = 0; $i < $cnt; $i++) {
                                                                if ($i < $cnt - 1) {
                                                                    echo $data["tags"][$i]["name"] . ', ';
                                                                } else {
                                                                    echo $data["tags"][$i]["name"];
                                                                }
                                                            }
                                                            ?>">
                </td>
            </tr>
            <tr>
                <td>Backorder Permission: <br>
                    <input type="radio" id="yes" value="yes" name="backorders"> Yes <br>
                    <input type="radio" id="notify" value="notify" name="backorders"> Yes, but must inform customer <br>
                    <input type="radio" id="no" value="no" name="backorders"> No <br>
                    <?php
                    $backorders = $data["backorders"];
                    if ($backorders === 'yes') {
                        $backordersCheck = 'yes';
                    } else if ($backorders === 'notify') {
                        $backordersCheck = 'notify';
                    } else if ($backorders === 'no') {
                        $backordersCheck = 'no';
                    }
                    $backordersCheckingScript = <<<JAVASCRIPT
                    <script>
                    document.getElementById('$backordersCheck').checked = true;
                    </script>
                    JAVASCRIPT;
                    echo $backordersCheckingScript;
                    ?>
                </td>
                <td>Post Status: <br>
                    <input type="radio" id="publish" name="status" value="publish"> <label style="margin-right: 30px;">Publish</label>
                    <input type="radio" id="pending" name="status" value="pending"> <label>Pending</label> <br>
                    <input type="radio" id="private" name="status" value="private"> <label style="margin-right: 32px;">Private
                    </label>
                    <input type="radio" id="draft" name="status" value="draft"> <label>Draft</label>
                </td>
                <?php
                $status = $data["status"];
                if ($status === 'publish') {
                    $radioButtonToCheck = 'publish';
                } elseif ($status === 'pending') {
                    $radioButtonToCheck = 'pending';
                } elseif ($status === 'private') {
                    $radioButtonToCheck = 'private';
                } else {
                    $radioButtonToCheck = 'draft';
                }
                $radioButtonCheckingScript = <<<JAVASCRIPT
                <script>
                    document.getElementById('$radioButtonToCheck').checked = true;
                </script>
                JAVASCRIPT;
                echo $radioButtonCheckingScript;
                ?>
                <td>SKU: <br>
                    <input name="sku" type="text" value="<?php echo $data["sku"]; ?>">
                </td>
                <td rowspan="2">
                    Categories: <br>
                    <?php
                    $categoryData = file_get_contents('http://localhost/fluffybunny/api/categories');
                    $allCategories = json_decode($categoryData, true);
                    foreach ($allCategories as $category) {
                        $isChecked = false;
                        foreach ($data['categories'] as $prodCategory) {
                            if ($category['id'] == $prodCategory['id']) {
                                $isChecked = true;
                                break;
                            }
                        }
                        if ($isChecked) {
                            echo "<input type='checkbox' checked name='category[]' value='{$category['id']}'>";
                        } else {
                            echo "<input type='checkbox' name='category[]' value='{$category['id']}'>";
                        }
                        echo "<label style='margin-left: 10px;'>{$category['name']}</label><br>";
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td colspan=3>
                    Description:
                    <div class="editor-box">
                        <textarea name="editor" id="editor"><?php echo html_entity_decode($data["description"]); ?></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan=4>
                    Images:
                    <!-- <a style="color: blue;"
                        href="http://localhost/fluffybunny/api/products?id=$id&action=addimage"><u>Add
                            an image</u></a> -->
                    <ul class="prod-images">
                        <?php
                        for ($i = 0; $i < count($data["images"]); $i++) {
                            $image_url = $data['images'][$i]['src'];
                            $img_id = $data['images'][$i]['id'];
                            echo "<li style='text-align:right;'><img src = '$image_url'><br><label style = 'color:red; margin-right: 10px;'>Delete</label><input type = 'checkbox' name ='image[]' value = '$img_id'></li>";
                        }
                        ?>
                    </ul>
                    <ul>
                        Add: <input type="file" name="add_images[]" multiple />
                    </ul>
                </td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <ul class="product_action_btn">
                        <li>
                            <a href="http://localhost/fluffybunny/api/products?id=<?php echo $data['id'] ?>&action=delete" id="deleteProduct">Delete</a>
                        </li>
                        <li style="background-color: blue;">
                            <input type="submit" name="submit" value="Update" style="background-color: blue; border: none; cursor: pointer; color: white">
                        </li>
                    </ul>
                </td>
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