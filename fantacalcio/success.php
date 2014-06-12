<?php

include './include/template2.inc.php';
include './include/auth.inc.php';

	$base_path="./dtml/";
	$base=new Template($base_path."base.html");
	if(isLogged()){
		$base_path_user="./dtml/user/";
		$login=new Template($base_path_user."login.html");
		$login->setContent("USERNAME", $_SESSION['user']);
	}
	else{
		$login=new Template($base_path."login.html");
	}
	switch ($_GET['code']){
		case "subscription":
			$title="Iscrivizione avvenuta<br>con successo";
			$message="La tua iscrizione è andata a buon fine. Ora puoi accedere a Fantaweb e cominciare a giocare!";
			break;		
		case "invite":
			$title="L'invito è stato elaborato<br>correttamente";
			$message="Hai accettato di far parte di una lega. Accedi alla lega e crea subito la tua rosa";
			break;	
		case "retrieve":
			$title="Recupero password elaborato<br>correttamente";
			$message="Ti è stata inviata una mail con la nuova password per accedere a Fantaweb";
			break;
	}
	$content=new Template($base_path."success.html");
	$content->setContent("SUCCESS_TITLE", $title);
	$content->setContent("SUCCESS_MESSAGE", $message);
	
	
	$menu=new Template($base_path."menu.html");
	$footer=new Template($base_path."footer.html");

	$base->setContent("LOGIN", $login->get());
	$base->setContent("MENU", $menu->get());
	$base->setContent("CONTENT", $content->get());
	$base->setContent("FOOTER", $footer->get());
	$base->close();



?>