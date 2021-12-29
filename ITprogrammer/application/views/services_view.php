<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div class="container bg-dark ">
  <table>
    <?php
    require_once "application/core/Database/connection.php";
    $db = new DataBase();
    $login = $_COOKIE['user'];
    $result = $db->query("SELECT * FROM `posts` WHERE `user`='$login' ORDER BY id DESC  ");
    foreach ($result as $url) {
      $category = $url['category'];
      $photo = $db->query("SELECT * FROM `category` WHERE `category`='$category'");
      $id = $url['id'];
      $comment = $db->query("SELECT * FROM `comments` WHERE `post_id`='$id' ORDER BY id DESC ");
      print_r('
    <div class="container border-bottom border-top  mt-1">
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
  </div></div>
  ');
      foreach ($comment as $comm) {
         $post_id=$comm['id'];
        $like=$db->query("SELECT * FROM `like_post` WHERE `post_id`='$post_id' ");
      
        $l=0;
        $d=0;
        foreach ($like as $com)
        {
          $l+=$com['like'];
          $d+=$com['dislike'];
        }
        $user = $comm['user'];
        $photo = $db->query("SELECT * FROM `users` WHERE `login`='$user'");
        print_r('<div class="container py-1"><div class="row shasdow">
<div class="col-3 bg-dark border border-light rounded" style="color:white"><div class="row"><div class="col-6"><img src="images/profil_photo/' . $user . '/' . $photo[0]['photo'] . '" width="90" height="90" class=" border border-white mt-1 mb-1"> </div><div class="col-6 mt-3">' . $comm['user'] .  '<br>' . explode(' ', $comm['date'])[1] . '<br> ' . explode(' ', $comm['date'])[0] . '</div></div></div>
<div class="col-9 bg-light border border-dark rounded">' . $comm['comment'] . '</div>
</div>
</div> </div> <div class="row"><div class="col-10"></div><div class="col"><button data-id="'.$comm['id'].'" data-usr="'.$_COOKIE['user'].'" class="like btn-danger"><i class="bi bi-hand-thumbs-up"></i> Like | '.$l.'</button><button  data-id="'.$comm['id'].'" data-usr="'.$_COOKIE['user'].'" class="dislike btn-dark" ><i class="bi bi-hand-thumbs-down"></i> | '.$d.'</button></div></div> ');
      }
    }
    ?>
  </table>
</div>