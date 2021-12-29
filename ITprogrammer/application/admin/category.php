<div class="container">
    <div class="row">
        <div class="col-8 bg-danger">
            <a href="/admin?post_name=category" class="btn btn-dark">Kатегории</a>
        </div>
        <div class="col-4 bg-danger">
            <a href="/admin?post_name=list_users" class="btn btn-dark  mb-1">Список пользователей</a>
        </div>
    </div>
    <table class="table table-dark table-striped align-middle">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Категория</th>
                <th scope="col">Изменить</th>
                <th scope="col">Удалить</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once "application/core/Database/connection.php";
            $db = new DataBase();
            $category = $db->query("SELECT * FROM `category`");
            $index = 0;
            foreach ($category as $url) {
                $index++;
                print_r('<tr>
                <th scope="row">' . $index . '</th>
                <td>' . $url['category'] . '</td>
                <td><a href="/update_category?post_name=' . $url['category'] . '" class="btn btn-danger" >Изменить</a></td>
                <td><form method="POST"><button class="btn btn-danger"" name="btn_delete" value=' . $url['category'] . '>Удалить</button></form></td>
                </tr>');
            }
            ?>
            <tr>
                <td scope="col"><a href="/add_category" class="btn btn-danger mb-3">Добавить</a></td>
            </tr>
        </tbody>

    </table>
</div>