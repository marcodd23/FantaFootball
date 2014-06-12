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
		case "403":
			$type="HTTP";
			$code=$_GET['code'];
			$title="Accesso alla pagina<br>non consentito";
			$message="Non hai i diritti per accedere a questa pagina. Se pensi ci sia un problema contatta l'amministratore";
			break;		
		case "500":
			$code=$_GET['code'];
			$type="HTTP";
			$title="La pagina che cerchi<br>non esiste";
			$message="Molto probabilmente i parametri della url non sono corretti. Se pensi non sia così contatta l'amministratore";
			break;		
		case 'login':
			$code=" login";
			$type="Errore";
			$title="Credenziali errate";
			$message="Le credenziali inserite non sono corrette. Riprova con altre credenziali o <a href='retrieve.php' id='retrieve'>recupera password</a>";
			break;
		case 'retrieve':
			$code=" recupero";
			$type="Errore";
			$title="Recupero email non riuscito";
			$message="Non esiste alcun utente iscritto con questa email oppure potrebbe un errore nell'invio della nuova password. Contatta l'amministratore del sistema o <a href='retrieve.php' id='retrieve'>riprova</a>";
			break;
	}
	$content=new Template($base_path."error.html");
	$content->setContent("TYPE", $type);
	$content->setContent("ERROR_CODE", $code);
	$content->setContent("ERROR_TITLE", $title);
	$content->setContent("ERROR_MESSAGE", $message);
	
	
	$menu=new Template($base_path."menu.html");
	$footer=new Template($base_path."footer.html");

	$base->setContent("LOGIN", $login->get());
	$base->setContent("MENU", $menu->get());
	$base->setContent("CONTENT", $content->get());
	$base->setContent("FOOTER", $footer->get());
	$base->close();



?>