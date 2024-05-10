<section>
    <?php
    session_start();
    $id = $_GET["id"];
    $data = file_get_contents("http://localhost/fluffybunny/api/categories?id=$id");
    $data = json_decode($data, true);
    if (isset($_POST["submit"]) && $_POST["submit"] == "Update") {
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["slug"] = $_POST["slug"];
        $_SESSION["parent"] = $_POST["parent"];
        header("Location: http://localhost/fluffybunny/api/categories/?id=$id&action=update");
    }
    ?>
    <form action="" method="POST" id="categoryDetails">
        <table border='0'>
            <tr>
                <td colspan=4>
                    Category name: <br>
                    <input name="name" required type="text" value="<?php echo $data["name"]; ?>">
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
                    Parent Category:
                    <select name="parent" id="">
                        <?php
                        $categoryData = file_get_contents('http://localhost/fluffybunny/api/categories');
                        $allCategories = json_decode($categoryData, true);
                        if ($data['parent'] == '0') {
                            echo "<option selected value = '0'>None</option>";
                        } else {
                            foreach ($allCategories as $category) {
                                if ($category['id'] == $data['parent']) {
                                    echo "<option selected value = '$category[id]'>$category[name]</option>";
                                }
                            }
                        }
                        foreach ($allCategories as $category) {
                            if ($category['id'] != $data['parent']) {
                                echo "<option value = '$category[id]'>$category[name]</option>";
                            }
                        }
                        if ($data["parent"]!=0){
                            echo "<option value = '0'>None</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="categories-action-btn">
                        <li>
                            <a href="http://localhost/fluffybunny/api/categories?id=<?php echo $data['id'] ?>&action=delete"
                                >Delete</a>
                        </li>
                        <li style="background-color: blue;">
                            <input type="submit" name="submit" value="Update"
                                style="background-color: blue; border: none; cursor: pointer; color: white">
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
    </form>
</section>
<style>
    #categoryDetails {
        width: 90%;
    }

    table {
        width: 100%;
    }

    input[type="text"] {
        width: 100%;
        height: 40px;
    }

    td {
        padding: 10px;
        vertical-align: top;
    }

    .categories-action-btn {
        display: flex;
        list-style: none;
    }

    .categories-action-btn li {
        margin-right: 20px;
        width: 80px;
        text-align: center;
        border: 1px solid black;
        padding: 10px;
    }
</style>