<?php
require_once "application/core/Database/connection.php";
class Controller_Admin extends Controller
{


	function action_index()
	{
		$this->db = new DataBase();

		if (isset($_POST['btn_delete'])) {
			$category = $_POST['btn_delete'];
			$this->db->execute("DELETE FROM `category` WHERE  `category`='$category' ");
			$this->db->execute("DELETE FROM `posts` WHERE  `category`='$category' ");
			header('Location:/admin?post_name=category');
		}

		$this->view->generate('admin_view.php', 'template_view.php');
	}
}
