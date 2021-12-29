<div class="container">

    <table class="table table-dark table-striped mt-5 align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Категория</th>
                <th scope="col">Изменить название категории</th>
                <th scope="col">загрузить новое фото </th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "application/core/Database/connection.php";
            $db = new DataBase();
            $category = $_GET['post_name'];
            $categoryy = $db->query("SELECT * FROM `category` WHERE `category`='$category' ");
            $index = 0;
            foreach ($categoryy as $url) {
                $index++;
                print_r('<tr>
                <th scope="row">' . $index . '</th>
                <td>' . $url['category'] . '</td>
                <th scope="col"><form action="" method="post" enctype="multipart/form-data"><input type="text" name="new_category"  class="form-control" placeholder="Введите новое название:"required>  </th>
                <th scope="col"><input type="file" name="file"><input type="submit"  class="btn-danger" value="Обновить"></form>
                </th>
              </tr>');
            }
            ?>
        </tbody>
    </table>
    <?php
    require_once "application/core/Database/connection.php";
    $db = new DataBase();
    $new_category = $_POST['new_category'];
    if (isset($_POST['new_category'])) {
        $file = $_FILES['file'];
        $name = $file['name'];
        $pathFile = 'images/' . $name;

        if (!move_uploaded_file($file['tmp_name'], $pathFile)) {
            $sql = $db->execute("UPDATE `category` SET `category`='$new_category' WHERE  `category`='$category'");
        }
        $sql = $db->execute("UPDATE `category` SET `category`='$new_category', `name_photo`='$name' WHERE  `category`='$category'");
    }

    ?>
</div>