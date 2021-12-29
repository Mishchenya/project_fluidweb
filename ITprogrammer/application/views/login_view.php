<div class="container bg-light">
  <div class="card-header">
    Авторизация
  </div>
  <form action="" method="post">
    <input class="form-control mt-2 mb-2" type="name" name="login" required="required" placeholder="Your Login">
    <input class="form-control mt-2 mb-2" type="password" name="password" required="required" placeholder="Your password">
    <div class="submit-wrap">
      <input class="btn btn-danger" type="submit" value="Продолжить" class="submit">
    </div>
  </form>
  <?php extract($data); ?>
  <?php if ($login_status == "access_denied") { ?>
    <p style="color:red">Логин или пароль введены неверно.</p>
  <?php } ?>
  <a href="/register">Нет аккаунта? Зарегистрируйтесь!</a>
</div>