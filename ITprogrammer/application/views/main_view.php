<div class="container bg-dark ">
  <nav class="navbar navbar-dark bg-light">
    <ul class="navbar navbar-nav mr-auto">
      <li class="nav-item">
        <form action="" method="post">
          <select name="filtr" class="form-select" required aria-label="select example">
            <option value="DESC">Сортировка по дате</option>
            <option value="DESC">Сначала новые</option>
            <option value="ASC">Сначала старые</option>
            <input type="submit" value="Применить" name="btn" class="btn-dark ml-1 rounded">
          </select>
        </form>
      </li>
      <li>
      </li>
    </ul>
    <form action="" method="post" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Поиск" aria-label="Search">
      <button class="btn btn-outline-dark my-2 my-sm-0" name="submit" type="submit">Поиск</button>
    </form>
  </nav>
  <div class="pb-4">
    <a class="btn btn-danger g-2 px-4" href="/create_question">Добавить вопрос</a>
  </div>
  <?php
  require_once "application/core/Database/connection.php";
  $db = new DataBase();
  if (isset($_POST['filtr'])) {
    $filtr = $_POST['filtr'];
  } else {
    $filtr = 'DESC';
  }
  if (isset($_POST['submit'])) {
    $search = explode(" ", $_POST['search']);
    $count = count($search);
    $array = array();
    $i = 0;
    foreach ($search as $key) {
      $i++;
      if ($i < $count) {
        $array[] = "CONCAT (`title`,`content`) LIKE '%" . $key . "%' OR ";
      } else {
        $array[] = "CONCAT (`title`, `content`) LIKE '%" . $key . "%'";
      }
    }
    $result = $db->query("SELECT * FROM `posts` WHERE " . implode("", $array));
    foreach ($result as $url) {
      $category = $url['category'];
      $photo = $db->query("SELECT * FROM `category` WHERE `category`='$category'");
      print_r('
    <div class="container mt-1">
  <div class="row border-dark border-bottom shadow-lg bg-white rounded pt-3 ">
      <div class="col-md-3">
        <a href="/post?post_id=' . $url['id'] . '" >
            <img src="images/' . $photo[0]['name_photo'] . '" class="pb-3" width="260" height="200"  class="rounded">
        </a>
      </div>
 
      <div class="col-md-9 " >
      <h4><a href="/post?post_id=' . $url['id'] . '">' . $url['title'] . '</a></h4>
        <p>
        ' . mb_substr($url['content'], 0, 250, 'UTF-8') . '...' . '
        </p>
        <p><a class="btn btn-danger "href="/post?post_id=' . $url['id'] . '">Читать далее</a></p>
        <br/>
        <ul class="nav">
            <li><i class="bi bi-person-fill pl-2 pr-1"></i>by <a href="/profil?post_name=' . $url['user'] . '">' . $url['user'] . '</a> | </li>
            <li><i class="bi bi-list-stars pl-2 pr-1"></i>' . $url['category'] . '| </li>
            <li><i class="bi bi-calendar-week pl-2 pr-1"></i>' . $url['datetime'] . '| </li>
            <li><i class="bi bi-chat-left-fill pl-2 pr-1"></i>' . $url['count_comm'] . ' Комментариев </li>
        </ul>
      </div>
  </div></div>');
    }
  } else {
    $result = $db->query("SELECT * FROM `posts` ORDER BY id $filtr ");
    foreach ($result as $url) {
      $category = $url['category'];
      $photo = $db->query("SELECT * FROM `category` WHERE `category`='$category'");
      print_r('
    <div class="container mt-1">
  <div class="row border-dark border-bottom shadow-lg bg-white rounded pt-3 ">
      <div class="col-md-3">
        <a href="/post?post_id=' . $url['id'] . '" >
            <img src="images/' . $photo[0]['name_photo'] . '" class="pb-3" width="260" height="200"  class="rounded">
        </a>
      </div>
 
      <div class="col-md-9 " >
      <h4><a href="/post?post_id=' . $url['id'] . '">' . $url['title'] . '</a></h4>
        <p>
        ' . mb_substr($url['content'], 0, 250, 'UTF-8') . '...' . '
        </p>
        <p><a class="btn btn-danger "href="/post?post_id=' . $url['id'] . '">Читать далее</a></p>
        <br/>
        <ul class="nav">
            <li><i class="bi bi-person-fill pl-2 pr-1"></i>by <a href="/profil?post_name=' . $url['user'] . '">' . $url['user'] . '</a> | </li>
            <li><i class="bi bi-list-stars pl-2 pr-1"></i>' . $url['category'] . '| </li>
            <li><i class="bi bi-calendar-week pl-2 pr-1"></i>' . $url['datetime'] . '| </li>
            <li><i class="bi bi-chat-left-fill pl-2 pr-1"></i>' . $url['count_comm'] . ' Комментариев </li>
        </ul>
      </div>
  </div></div>');
    }
  }
  ?>
</div>