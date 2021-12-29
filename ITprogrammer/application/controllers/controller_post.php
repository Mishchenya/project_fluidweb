<?php

class Controller_Post extends Controller
{

	function action_index()
	
	{
		$post_id=$_GET['post_id'];
		if (isset($_POST['comment'])) {
			if (isset($_POST['comment'])&& $_COOKIE['user'] == '') 
			{
				header('Location:/login');
			}
			else
			{
				header('Location:/post?post_id='.$_GET['post_id'].'');
			}
			
		}
		
		$this->view->generate('post_view.php', 'template_view.php');
	}
}
