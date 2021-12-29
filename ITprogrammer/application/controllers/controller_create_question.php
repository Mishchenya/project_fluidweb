<?php
require_once "application/core/Database/connection.php";
class Controller_Create_question extends Controller
{
    private $db;
    function __construct()
    {
        $this->db = new DataBase();
        $this->view = new View();
    }

    function action_index()
    {
        if ($_COOKIE['user'] == '') {
            header('Location:/login');
        } else {
            if (isset($_POST['title']) && isset($_POST['content'])) {
                $login = $_COOKIE['user'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $category = $_POST['category'];
                $this->db->execute("INSERT INTO `posts` (`user`,`title`,`content`,`category`,`datetime`) VALUES('$login',' $title',' $content','$category',now())");
                $_SESSION['title'] = '';

                header('Location:/');
            }
            $this->view->generate('create_question_view.php', 'template_view.php');
        }
    }
}
