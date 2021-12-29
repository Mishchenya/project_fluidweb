<div class="container bg-light">
    <div class="card-header">
        Регистрация
    </div>
    <form action="" method="post">
        <input class="form-control mt-2 mb-2" type="name" name="login" required="required" placeholder="Your Login">
        <?php extract($data); ?>
        <?php if ($login_status == "access_denied") { ?>
            <label style="color:red">Логин занят</label>
        <?php } ?>
        <input class="form-control mt-2 mb-2" type="password" name="pass" required="required" placeholder="Your password">
        <input class="form-control mt-2 mb-2" type="email" name="email" required="required" placeholder="Your email">
        <?php if ($email_status == "access_denied") { ?>
            <label style="color:red">Gmail занят</label>
        <?php } ?>
        <div class="form-check">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="man"> Мужской
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="gender" value="wuman">Женский
            </div>
        </div>
        <div class="submit-wrap">
            <input class="btn btn-danger" type="submit" value="Продолжить" class="submit">
        </div>
    </form>


</div>