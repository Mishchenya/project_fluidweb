<?php

class Controller_Update_category extends Controller
{

    function action_index()
    {
        if (isset($_POST['new_category'])) {
            header('Location:/admin?post_name=category');
        }
        $this->view->generate('update_category_view.php', 'template_view.php');
    }
}
