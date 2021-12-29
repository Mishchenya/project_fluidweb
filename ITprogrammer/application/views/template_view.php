<?php
session_start();
require_once "application/core/Database/connection.php";
$db = new DataBase();
$login = $_COOKIE['user'];
$photo = $db->query("SELECT * FROM `users` WHERE `login`='$login'");
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="images/logo_shortcut.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>ITprogramer</title>
</head>
<style>
    .btn {
        margin: 5px;
        margin-top: 10px;
        margin-bottom: -10px;
    }
</style>

<body style="background:url('images/bg-pattern.png');  background-attachment: fixed;">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                    <a class="navbar-brand" href="/">
                        <img src="images/logo.png" alt="" width="150" height="50" class="d-inline-block align-text-top">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav">
                            <a class="nav-item nav-link active" href="/">Главная<span class="sr-only">(current)</span></a>
                            <?php if ($_COOKIE['user'] == '') : ?>
                            <?php else : ?>
                                <a class="nav-item nav-link active" href="/services">Вопросы от пользователя</a>
                            <?php endif ?>
                            <?php if ($_COOKIE['user'] == 'admin') : ?>
                                <a class="nav-item nav-link active" href="/admin?post_name=category">Админка</a>
                            <?php endif ?>
                        </div>
                    </div>
                </nav>
                <form class="d-flex">
                    <?php if ($_COOKIE['user'] == '') : ?>
                        <a class="btn  btn-outline-light" type="submit" href="/register">Регистрация</a>
                        <a class="btn  btn-outline-light " type="submit" href="/login">Вход</a>
                    <?php else : ?>
                        <form class="d-flex">
                            <div class="nav-item dropdown">
                                <a class="btn dropdown-toggle" style="color:aliceblue;" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?= $_COOKIE['user'] ?>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                    <button class="dropdown-item" type="button" onclick="document.location='/my_profil'">Посмотреть профиль</button>
                                    <button class="dropdown-item" type="button" onclick="document.location='/logout'">Вийти из : <?= $_COOKIE['user'] ?></button>
                                </div>
                            </div>

                            <a href="/my_profil">
                                <?php if ($photo[0]['photo'] == '') : ?>
                                    <img src="images/profil_photo/default/<?= $_COOKIE['user_gender'] ?>_awatar.jpg" width="50" height="50" class="rounded-circle border border-white">
                                <?php else : ?>
                                    <img src="images/profil_photo/<?= $_COOKIE['user'] ?>/<?= $photo[0]['photo'] ?>" width="50" height="50" class="rounded-circle border border-white">
                                <?php endif ?>
                            </a>
                        <?php endif ?>
                        </form>
            </div>
        </div>
    </nav>
    <nav class="navbar bg-danger"></nav>
    <div class="container-fluid px-4">
        <?php include 'application/views/' . $content_view; ?></div>

</body>


</html>