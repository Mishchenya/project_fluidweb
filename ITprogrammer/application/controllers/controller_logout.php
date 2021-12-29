<?php
class Controller_LogOut extends Controller
{
    function action_index()
    {
        setcookie('user', $_COOKIE['user'], time()-3600,'/');
        header('Location: /');
    }
}
