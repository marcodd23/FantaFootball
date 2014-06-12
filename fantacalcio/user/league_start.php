<?php

include '../include/template2.inc.php';
// include '../include/dbms.inc.php';
include '../include/auth.inc.php';
	
		checkAuthorization("user/league_start.php");
		
		$base_path="../dtml/user/";
		$base=new Template($base_path."base.html");
		$login=new Template($base_path."login.html");
		$login->setContent("USERNAME", $_SESSION['user']);
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."league_form.html");
		if(isset($_GET['action'])){
			switch ($_GET['action']){
				case 'create':
					$content->setContent("TITLE", "Crea");
					break;
				case 'update':
					$content->setContent("TITLE", "Modifica");
					break;
			}
			$content->setContent("ACTION", $_GET['action']);
		}
		$footer=new Template($base_path."footer.html");
	
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();
?>