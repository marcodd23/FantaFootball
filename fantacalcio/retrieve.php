<?php

include './include/template2.inc.php';
include './include/auth.inc.php';
include './include/mailer.inc.php';

function generateRandomString($length) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}
	//checkAuthorization("subscription_start.php");
		if (isset($_GET['action'])){
			if($_GET['action']=='submit'){
				$result=mysql_query("SELECT * FROM utenti WHERE email='{$_POST['email']}'");
				if(mysql_num_rows($result)==0){
					//echo "utente non trovato<br>";
					header("Location:error.php?code=retrieve");
				}
				else{
					$new_password=generateRandomString(8);
					echo $new_password."<br>";
					$hash=md5($new_password);
					echo $hash."<br>";
					$result=mysql_query("UPDATE utenti SET password='{$hash}' WHERE email='{$_POST['email']}'");
					if(!$result)echo mysql_error()."<br>";
					$invio=inviamail($_POST['email'], "Fantaweb: recupero password",
							"La nuova password &egrave; ".$new_password.".\nPotrai cambiarla al primo accesso");
					//echo var_dump($invio);
					if(!$invio['error'])
						header("Location:success.php?code=retrieve");
					else
						header("Location:error.php?code=retrieve");
				}
			}
		}
		
		$base_path="./dtml/";
		$base=new Template($base_path."base.html");
		if(isLogged()){
			$username=$_SESSION['user'];
			$base_path_user="./dtml/user/";
			$login=new Template($base_path_user."login.html");
			$login->setContent("USERNAME", $username);
		}
		else $login=new Template($base_path."login.html");
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."retrieve.html");
				
		$footer=new Template($base_path."footer.html");
	
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();

?>