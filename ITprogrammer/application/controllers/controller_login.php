<?php
require_once "application/core/Database/connection.php";
class Controller_Login extends Controller
{
	private $db;
	function __construct()
	{
		$this->db = new DataBase();
		$this->view = new View();
	}

	function action_index()
	{


		if (isset($_POST['login']) && isset($_POST['password'])) {
			$login = $_POST['login'];
			$pass = $_POST['password'];
			$pass = md5($pass . $_POST['login']);
			$users = $this->db->query("SELECT * FROM `users` WHERE  `login`='$login' AND `pass`='$pass'");

			if ($login == $users[0]['login'] && $pass == $users[0]['pass']) {
				$data["login_status"] = "access_granted";
				setcookie('user', $users[0]['login'], time() + 3600, '/');
				setcookie('user_gender', $users[0]['gender']);
				header('Location:/');
			} else {
				$data["login_status"] = "access_denied";
			}
		} else {
			$data["login_status"] = "";
		}

		$this->view->generate('login_view.php', 'template_view.php', $data);
	}
}
