<section>
    <?php
    session_start();
    if (isset($_POST["submit"]) && $_POST["submit"] == "Add") {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["slug"] = $_POST["slug"];
        $_SESSION["parent"] = $_POST["parent"];
        $_SESSION["description"] = $_POST["description"];
        header("Location: http://localhost/fluffybunny/api/categories/?action=add");
    }
    ?>
    <form action="" method="POST" id="categoryAddForm">
        <table border='0'>
            <tr>
                <td colspan=4>
                    Category name: <br>
                    <input name="name" required type="text">
                </td>
            </tr>
            <tr>
                <td colspan=4>
                    Slug: <br>
                    <input name="slug" style="color: blue;" type="text">
                </td>
            </tr>
            <tr>
                <td colspan=4>
                    Description: <br>
                    <input name="description" type="text">
                </td>
            </tr>
            <tr>
                <td>
                    Parent Category:
                    <select name="parent" id="">
                        <option value='0'>None</option>
                        <?php
                        $categoryData = file_get_contents('http://localhost/fluffybunny/api/categories');
                        $allCategories = json_decode($categoryData, true);
                            foreach ($allCategories as $category) {
                                        echo "<option value = '$category[id]'>$category[name]</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <ul class="categories-action-btn">
                        <li style="background-color: blue;">
                            <input type="submit" name="submit" value="Add"
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