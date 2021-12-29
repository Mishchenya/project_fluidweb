<?php
require_once "application/core/Database/connection.php";
$db = new DataBase();
$user = $_GET['post_name'];
$db_users = $db->query("SELECT * FROM `users` WHERE `login`='$user'"); ?>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col">
            <div class="row g-0">
                <div class="col-sm-6 col-md-10">
                    <div class="card mt-4 bg-dark" style="width: 25rem;">
                        <?php if ($photo[0]['photo'] == '') : ?>
                            <img src="images/profil_photo/default/<?= $db_users[0]['gender'] ?>_awatar.jpg" class="card-img-top">
                        <?php else :  ?>
                            <img src="images/profil_photo/<?= $user ?>/<?= $db_users[0]['photo'] ?>" class="card-img-top">
                        <?php endif ?>

                        <div class="card-body">
                            <h5 class="card-title " style="color:white;"> <?= $user ?></h5>
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

            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>

<?php

?>