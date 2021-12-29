<div class="container bg-white">
  <form action="" method="post" class="was-validated">
    <div class="mb-3">
      <label for="validationTextarea" class="form-label">Вопрос</label>
      <textarea class="form-control is-invalid" id="validationTextarea" name="title" placeholder="Введите описание" required><?= $_SESSION['title'] ?></textarea>
      <div class="invalid-feedback">
        Пожалуйста, введите название вопроса в текстовое поле.
      </div>
    </div>
    <div class="mb-3">
      <label for="validationTextarea" class="form-label">Описание</label>
      <textarea class="form-control is-invalid" id="validationTextarea" name="content" placeholder="Введите описание" required><?= $_SESSION['content'] ?></textarea>
      <div class="invalid-feedback">
        Пожалуйста, введите описание.
      </div>
    </div>
    <div class="mb-3">
      <select name="category" class="form-select" required aria-label="select example">
        <option value="">Выберете категорию</option>
        <?php
        require_once "application/core/Database/connection.php";
        $db = new DataBase();
        $result = $db->query("SELECT * FROM `category`");
        foreach ($result as $url) {
          print_r(' <option value="' . $url['category'] . '">' . $url['category'] . '</option>');
        }
        ?>
      </select>
      <div class="invalid-feedback">Выберете категорию</div>
    </div>
    <div class="mb-3">
      <button class="btn btn-danger" name="button" type="submit" value="Опубликовать">Опубликовать</button>
      <button class="btn btn-danger" name="button" type="submit" value="В черновик">В черновик</button>
    </div>
  </form>
</div>
<?php
if ($_POST['button'] == 'В черновик') {
  $_SESSION['title'] = $_POST['title'];
  $_SESSION['content'] = $_POST['content'];
}
if ($_POST['button'] == 'Опубликовать') {
  $_SESSION['title'] = '';
  $_SESSION['content'] = '';
}
?>