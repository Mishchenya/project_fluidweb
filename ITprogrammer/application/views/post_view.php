<div class="container bg-white">
  <?php
  require_once "application/core/Database/connection.php";
  $db = new DataBase();
  $id = $_GET['post_id'];
  $post = $db->query("SELECT * FROM `posts` WHERE `id`='$id'");
  foreach ($post  as $url) {
    $category = $url['category'];
    $photo = $db->query("SELECT * FROM `category` WHERE `category`='$category'");
    print_r('
<div class="row shadow-sm rounded pt-4">
    <div class="col-md-12 ">
   <div class=""><h1>' . $url['title'] . '</h1></div>
   <ul class="nav">
       <li><i class="bi bi-person-fill pl-2 pr-1"></i>by <a href="#">' . $url['user'] . '</a> | </li>
       <li><i class="bi bi-list-stars pl-2 pr-1"></i>' . $url['category'] . ' | </li>
       <li><i class="bi bi-calendar-week pl-2 pr-1"></i>' . $url['datetime'] . ' </li>
   </ul>
   <div class="post-content pt-2">
          <img src="images/' . $photo[0]['name_photo'] . '" width="260" height="200"  align="left" class="rounded pr-3 pb-3">  
          ' . $url['content'] . '</div>
    </div>
</div>');
  }
  ?>
  <?php if ($_COOKIE['user'] == '') : ?>
    <div class="pt-3">
      <div class="modal-body ">
        <div> Для того чтоб оставить комментарий нужно войти в <a href="" data-toggle="modal" data-target="#myModal">аккаунт</a>
        </div>
        <div class="modal fade" id="myModal" style="color: white;">
          <div class="modal-dialog">
            <div class="modal-content bg-dark">
              <div class="modal-header">
                <h1 class="pl-5">Войдите в аккаунт</h1>
              </div>
              <p>
              <form action="/login_modal?post_id=<?= $id ?>" method="post">
                <div class="mb-3 p-2">
                  <label for="recipient-name" class="col-form-label">Логин:</label>
                  <input class="form-control" type="text" name="login">
                </div>
                <div class="mb-3 p-2">
                  <label for="recipient-name" class="col-form-label">Пароль:</label>
                  <input type="text" class="form-control" name="password">
                </div>
                <input class="btn btn-danger" type="submit" value="Войти" name="btn" style="width: 150px; height: 30px;"></th>
              </form>
              </p>
              <a class="pl-3" href="/register">Нет аккаунта? Зарегистрируйтесь!</a>
            </div>
          </div>
        </div>
      </div>
    <?php else : ?>
      <div class="shadow-sm rounded pt-4">
        <form action="" method="post">

          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Оставить ответ:</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="2" required="required"></textarea>
          </div>
          <input class="btn btn-danger mb-3" type="submit">
        </form>
      </div>
    <?php endif ?>
    <?php
    if (isset($_POST['comment'])) {
      if ($_COOKIE['user'] == '') {
      } else {
        $comment = filter_var(
          trim($_POST['comment']),
          FILTER_SANITIZE_STRING
        );
        $user = $_COOKIE['user'];
        $add_comment = $db->execute("INSERT INTO `comments` (`comment`, `user`,`post_id`, `date`) VALUES('$comment','$user',$id,now())");
      }
    }
    ?>
    <table>
      <?php
    

      $comment = $db->query("SELECT * FROM `comments` WHERE `post_id`='$id' ORDER BY id DESC ");
      $i = 0;
      foreach ($comment as $comm) {
        $user = $comm['user'];
        $post_id=$comm['id'];
        $photo = $db->query("SELECT * FROM `users` WHERE `login`='$user'");
        $like=$db->query("SELECT * FROM `like_post` WHERE `post_id`=' $post_id' ");
      $l=0;
      $d=0;
      foreach ($like as $com)
      {
        $l+=$com['like'];
        $d+=$com['dislike'];
      }
        $i++;
        print_r('<div class="row px-2 shasdow">
  <div class="col-3 bg-dark border border-dark rounded" style="color:white"><div class="row"><div class="col-6"><img src="images/profil_photo/' . $user . '/' . $photo[0]['photo'] . '" width="90" height="90" class=" border border-white mt-1 mb-1"> </div><div class="col-6 mt-3">' . $comm['user'] .  '<br>' . explode(' ', $comm['date'])[1] . '<br> ' . explode(' ', $comm['date'])[0] . '</div></div></div>
  <div class="col-9 border border-dark rounded">' . $comm['comment'] . '</div>
</div>
</div><div class="row"><div class="col-10"></div><div class="col"><button data-id="'.$comm['id'].'" data-usr="'.$_COOKIE['user'].'" class="like btn-danger"><i class="bi bi-hand-thumbs-up"></i> Like | '.$l.'</button><button  data-id="'.$comm['id'].'" data-usr="'.$_COOKIE['user'].'" class="dislike btn-dark" ><i class="bi bi-hand-thumbs-down"></i> | '.$d.'</button></div></div> <br>');
      }


      $sql = $db->execute("UPDATE posts SET count_comm='$i' WHERE id='$id'");
      ?>
    </table>
    <?php
    ?>
    <script>
      var myModal = document.getElementById('myModal')
      var myInput = document.getElementById('myInput')

      myModal.addEventListener('shown.bs.modal', function() {
        myInput.focus()
      })
    </script>
    </div>
    <script>
      //like
        $(document).ready(function(){
          $('.like').bind('click', function() {
        var link = $(this);
        var id = link.data('id');
        var usr = link.data('usr');
            console.log(id,usr)
        $.ajax({
            url: "",
            type: "POST",
            data: {id:id, usr:usr},
            
        });
      });
      });

    //dislike
      $(document).ready(function(){
          $('.dislike').bind('click', function() {
        var link = $(this);
        var id = link.data('id');
        var usr = link.data('usr');
            console.log(id,usr)
        $.ajax({
            url: "",
            type: "POST",
            data: {dis_id:id, dis_usr:usr}, 
        });
      });
      });

    </script>
  
 <?php 
  if(isset($_POST['id']) && isset($_POST['usr']) || isset($_POST['dis_id']) && isset($_POST['dis_usr']) )
{
$post_id=$_POST['id'];
$post_id_2=$_POST['dis_id'];
$user_2=$_POST['dis_usr'];
$user=$_POST['usr'];
$like_com=$db->query("SELECT * FROM `like_post` WHERE `post_id`='$post_id' AND `user_name`='$user' OR `post_id`='$post_id_2' AND `user_name`='$user_2' ");
$w = 0;
foreach ($like_com as $com)
{
  $w++;
}
if($w==0)
{
  if(isset($_POST['id']) && isset($_POST['usr']))
  {
    $post_id=$_POST['id'];
    $user=$_POST['usr'];
    $db->execute("INSERT INTO `like_post` (`post_id`,`user_name`,`like`) VALUES('$post_id','$user','1')");
  }
  else
  {
    $post_id=$_POST['dis_id'];
    $user=$_POST['dis_usr'];
    $db->execute("INSERT INTO `like_post` (`post_id`,`user_name`,`dislike`) VALUES('$post_id','$user','1')");
  }
}
else
{
  if(isset($_POST['id']) && isset($_POST['usr']))
  {
    $post_id=$_POST['id'];
    $user=$_POST['usr'];
    $db->execute("UPDATE `like_post` SET `like`='1',`dislike`='0' WHERE `post_id`='$post_id' AND `user_name`='$user'");
  }
  else
  {
    $post_id=$_POST['dis_id'];
    $user=$_POST['dis_usr'];
    $db->execute("UPDATE `like_post` SET `like`='0',`dislike`='1' WHERE `post_id`='$post_id' AND `user_name`='$user'");
  }
}
 
}
?>

