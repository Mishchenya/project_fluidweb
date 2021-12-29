<?php
require_once "application/core/Database/connection.php";
class Controller_Register extends Controller
{
	private $db;
	function __construct()
	{
		$this->db = new DataBase();
		$this->view = new View();
	}
	
	function action_index()
	{
		if(isset($_POST['login']) && isset($_POST['pass']))
		{
		$login = filter_var(
			trim($_POST['login']),
			FILTER_SANITIZE_STRING
		);
		$pass = filter_var(
			trim($_POST['pass']),
			FILTER_SANITIZE_STRING
		);
		$gmail = filter_var(
			trim($_POST['email']),
			FILTER_SANITIZE_STRING
		);
		$gender = $_POST['gender'];
		$pass = md5($pass .$_POST['login']);
		$users=$this->db->query("SELECT * FROM `users` ");
		if(($login==$users[0]['login'] and $gmail=$users[0]['email']) or ($login==$users[0]['login']) or ($gmail=$users[0]['email']) )	
		{	
			if($login==$users[0]['login'] && $gmail=$users[0]['email']){
				$data["login_status"] = "access_denied";
				$data["email_status"] = "access_denied";
			}
			else
			{
				if($login==$users[0]['login'])
				{
					$data["login_status"] = "access_denied";
				}
				else
				{
					$data["email_status"] = "access_denied";
				}
			}
		
		}	
		
		else
		{
			
		$this->db->execute("INSERT INTO `users` (`login`, `pass`,`email`, `gender`) VALUES('$login','$pass','$gmail','$gender')");
		header('Location:/login');
		}
	}
	else
	{
		$data["regist_status"] = "";
	}

		
		$this->view->generate('register_view.php', 'template_view.php',$data);
	}
	
}
