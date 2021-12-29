<?php
require_once "application/core/Database/connection.php";

$db = new DataBase();
$login = $_COOKIE['user'];
$db_users = $db->query("SELECT * FROM `users` WHERE `login`='$login'");
?>

<div class="container">
    <div class="row pb-4">
        <div class="col-4">
            <div class="card mt-4 bg-dark " style="width: 18rem;">

                <?php if ($photo[0]['photo'] == '') : ?>
                    <img src="images/profil_photo/default/<?= $_COOKIE['user_gender'] ?>_awatar.jpg" class="card-img-top">
                <?php else :  ?>
                    <img src="images/profil_photo/<?= $_COOKIE['user'] ?>/<?= $db_users[0]['photo'] ?>" class="card-img-top">
                <?php endif ?>

                <div class="card-body">
                    <h5 class="card-title " style="color:white;"> <?= $_COOKIE['user'] ?></h5>
                    <p class="">
                    <div style="color:green">В сети</div>
                    </p>

                    <ul class="list-group list-group-flush" style="color:white;">
                        <li class="list-group-item bg-dark">Пол: <?php if ($db_users[0]['gender'] == 'man') : ?>Мужской<?php else : ?>женский<?php endif ?></li>
                        <li class="list-group-item bg-dark">Дата рождения: <?= $db_users[0]['age'] ?> </li>
                        <li class="list-group-item bg-dark">О себе: <?= $db_users[0]['info'] ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="mt-4">
                <table class="table table-dark table-striped">
                    <thead>
                        <th scope="col"></th>
                        <th scope="col"></th>
                        <th scope="col">Настройки профиля</th>

                    </thead>
                    <tbody>
                        <tr>
                            <th></th>
                            <td>Замена фото</td>
                            <td>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="file" name="file"><input type="submit" value="загрузить">
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>Замена Пароля</td>
                            <td>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <input type="password" name="password" required="required" placeholder="Введите старый пароль">
                                    <input type="password" name="new_password" required="required" placeholder="Введите новый пароль">
                                    <input type="submit" value="изменить">
                                    <?php
                                    //изменение пароля
                                    if (isset($_POST['password']) && isset($_POST['new_password'])) {
                                        $pass = filter_var(
                                            trim($_POST['new_password']),
                                            FILTER_SANITIZE_STRING
                                        );
                                        $pass = md5($pass . $login);
                                        $old_pass = md5($_POST['password'] . $login);
                                        if ($old_pass == $db_users[0]['pass']) {
                                            $db->execute("UPDATE `users` SET `pass`='$pass' WHERE `login`='$login'");
                                        } else {
                                            print_r('<div style="color: #ff5c5c">Старый пароль не верный</div>');
                                        }
                                    }
                                    ?>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <form action="" method="post">Дата рождения
                            </td>
                            <td><input name="date" type="date" required><input type="submit" value="Применить"></form>
                            </td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>Расскажите о себе</td>
                            <td>
                                <form action="" method="post"><textarea class="form-control" id="validationTextarea" name="info" placeholder="Расскажите о себе" required></textarea><input class="btn-danger mt-1" type="submit" value="Опубликовать"></form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
<!-- Загрузка фото -->
<?php

$papka = $_COOKIE['user'];
if (!empty($_FILES['file'])) {
    if (file_exists("$papka")) {
        $file = $_FILES['file'];
        $name = $file['name'];
        $pathFile = 'images/profil_photo/' . $papka . '/' . $name;
        if (!move_uploaded_file($file['tmp_name'], $pathFile)) {
            echo 'ошибка загрузки!';
        }
        $sql = $db->execute("UPDATE `users` SET `photo`='$name' WHERE `login`='$login'");
    } else {
        mkdir("images/profil_photo/$papka");
        $file = $_FILES['file'];
        $name = $file['name'];
        $pathFile = 'images/profil_photo/' . $papka . '/' . $name;
        if (!move_uploaded_file($file['tmp_name'], $pathFile)) {
            echo 'ошибка загрузки!';
        }
        $sql = $db->execute("UPDATE `users` SET `photo`='$name' WHERE `login`='$login'");
    }
} ?>
<!-- Настройки профиля -->
<?php
//загрузка даты
if (isset($_POST['date'])) {
    $data = $_POST['date'];
    $db->execute("UPDATE `users` SET `age`='$data' WHERE `login`='$login'");
}
//загрузка информации
if (isset($_POST['info'])) {
    $info = $_POST['info'];
    $db->execute("UPDATE `users` SET `info`='$info' WHERE `login`='$login'");
}
?>
</div>