<?php

include './include/template2.inc.php';
include './include/auth.inc.php';
include './include/securimage.php';

	checkAuthorization("subscription.php");

	$name=trim($_REQUEST['name']);
	$surname=trim($_REQUEST['surname']);
	$email=trim($_REQUEST['email']);
	$username=trim($_REQUEST['username']);
	$password=trim($_REQUEST['password']);
	$captcha=trim($_REQUEST['captcha']);
	 	
	$error=false;
	if($name==""){
		$name_message="Il nome è obbligatorio";
		$error=true;
	}
	if($surname==""){
		$surname_message="Il cognome è obbligatorio";
		$error=true;
	}
	$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
	if($email=="" || !preg_match($regex, $email)){
		$email_message="Inserisci un indirizzo email valido";
		$error=true;
	}
	else{
		$query="SELECT email FROM utenti WHERE email='{$email}'";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			$email_message="Email già esistente";
			$error=true;
		}
	}
	if($username==""|| strlen($username)<6){
		$username_message="L'username deve contenere almeno 6 caratteri";
		$error=true;
	}
	else{
		$query="SELECT username FROM utenti WHERE username='{$username}'";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			$username_message="Username già esistente";
			$error=true;
		}
	}
	if($password=="" || strlen($password)<8){
		$password_message="La password deve contenere almeno 8 caratteri";
		$error=true;
	}
	$securimage = new Securimage();
	if ($securimage->check($captcha) == false) {
		$captcha_message="Inserisci correttamente il captcha";
		$error=true;
	}
	
	if($error){
		$class="error";
		$base_path="./dtml/";
		$base=new Template($base_path."base.html");
		$login=new Template($base_path."login.html");
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."subscription_form.html");
		$footer=new Template($base_path."footer.html");
		
		$content->setContent("CLASS", $class);		
		$content->setContent("NAME_MESSAGE", $name_message);		
		$content->setContent("NAME_VALUE", $name);		
		$content->setContent("SURNAME_MESSAGE", $surname_message);		
		$content->setContent("SURNAME_VALUE", $surname);		
		$content->setContent("EMAIL_MESSAGE", $email_message);		
		$content->setContent("EMAIL_VALUE", $email);			
		$content->setContent("USERNAME_MESSAGE", $username_message);		
		$content->setContent("USERNAME_VALUE", $username);		
		$content->setContent("PASSWORD_MESSAGE", $password_message);		
		$content->setContent("PASSWORD_VALUE", $password);	
		$content->setContent("CAPTCHA_MESSAGE", $captcha_message);
		
				
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();
	}
	else{
		$password=md5($password);
		if(!mysql_query("INSERT INTO utenti (nome,cognome,email,username,password,gruppo)VALUES('{$name}','{$surname}','{$email}','{$username}','{$password}',3)")){			   
			echo(mysql_error());
		}
		else{
			header("Location:success.php?code=subscription");
		}
	}

?>