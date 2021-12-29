<?php 
if($_GET['post_name']=='category')
{
    include 'application/admin/category.php'; 
}
else
{
    include 'application/admin/list_users.php'; 
}