<?php

include '../include/template2.inc.php';
include '../include/auth.inc.php';
	
	//checkAuthorization("subscription_start.php");
//isAuthorized("subscription_start.php");
	//if(isAuthorized("subscription_start.php")){
		
		$base_path="../dtml/user/";
		$base=new Template($base_path."base.html");
		$login=new Template($base_path."login.html");
		$login->setContent("USERNAME", $_SESSION['user']);
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."updateProfile_form.html");
		$result=mysql_query("SELECT * FROM utenti WHERE username='{$_SESSION['user']}'");
		if(!$result)echo mysql_error();
		$utente=mysql_fetch_assoc($result);
		
		$content->setContent("NAME_VALUE", $utente['nome']);
		$content->setContent("SURNAME_VALUE", $utente['cognome']);
		$content->setContent("EMAIL_VALUE", $utente['email']);
		$content->setContent("USERNAME_VALUE", $utente['username']);
		$footer=new Template($base_path."footer.html");
	
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();
	//}
	//else{
		//header("Location:error.php?code=403");
	//}


?>