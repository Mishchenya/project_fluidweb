<?php

class Controller_Profil extends Controller
{

	function action_index()
	{
		$this->view->generate('profil_view.php', 'template_view.php');
		
	}
}
