<?php

class Controller_My_profil extends Controller
{

    function action_index()
    {
        if (isset($_FILES['file'])) {
            header('Location:/my_profil');
        }
        if (isset($_POST['date'])) {
            header('Location:/my_profil');
        }
        if (isset($_POST['info'])) {
            header('Location:/my_profil');
        }
        $this->view->generate('my_profil_view.php', 'template_view.php');
    }
}
