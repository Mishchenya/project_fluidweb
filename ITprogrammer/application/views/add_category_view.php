<div class="container">
    <table class="table table-dark table-striped mt-5 align-middle">
        <thead>
            <tr>
                <th scope="col">Введите название категории</th>
                <th scope="col">загрузить фото категории</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="col">
                    <form action="" method="post" enctype="multipart/form-data"><input type="text" name="new_category" class="form-control" placeholder="Введите название:" required>
                </th>
                <th scope="col"><input type="file" name="file" required><input type="submit" value="Добавить"></form>
                </th>
            </tr>
        </tbody>
    </table>
    <?php
    require_once "application/core/Database/connection.php";
    $db = new DataBase();
    $new_category = $_POST['new_category'];
    if (isset($_POST['new_category'])) {
        $file = $_FILES['file'];
        $name = $file['name'];
        $pathFile = 'images/'.$name;
        if (!move_uploaded_file($file['tmp_name'], $pathFile)) {
            echo 'ошибка загрузки!';
        }
        $db->execute("INSERT INTO `category` (`category`,`name_photo`) VALUES('$new_category','$name')");
    }
    ?>
</div>