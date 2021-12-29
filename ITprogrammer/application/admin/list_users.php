<div class="container">
 <div class="row">
    <div class="col-8 bg-danger">
        <a href="/admin?post_name=category"class="btn btn-dark">Kатегории</a>
    </div>
    <div class="col-4 bg-danger">
    <a href="/admin?post_name=list_users" type=""class="btn btn-dark  mb-1">Список пользователей</a>    
    </div>
  </div>
     <table class="table table-dark table-striped align-middle">
         <thead>
             <tr >
                 <th scope="col">#</th>
                 <th scope="col">Пользователь</th>
             </tr>
         </thead>
         <tbody>
             <?php
                require_once "application/core/Database/connection.php";
                $db = new DataBase();
                $category = $db->query("SELECT * FROM `users`");
                $index = 0;
                foreach ($category as $url) {
                    $index++;
                    print_r('<tr>
                <th scope="row">' . $index . '</th>
                <td>' . $url['login'] . '</td>');
                }
                ?>
         </tbody>

     </table>
 </div>