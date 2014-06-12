<?php

include '../include/template2.inc.php';
include '../include/auth.inc.php';

	//checkAuthorization("subscription.php");

	$name=trim($_REQUEST['name']);
	$surname=trim($_REQUEST['surname']);
	$email=trim($_REQUEST['email']);
	$username=trim($_REQUEST['username']);
	$password=trim($_REQUEST['password']);
	
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
		$query="SELECT email,username FROM utenti WHERE email='{$email}'";
		$result=mysql_query($query);
		if(mysql_num_rows($result)>0){
			$utente=mysql_fetch_assoc($result);
			var_dump($utente);
			echo $utente['username']." - ".$_SESSION['user']."<br>";
			if($utente['username']!=$_SESSION['user']){
				$email_message="Email già esistente";
				$error=true;
			}
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
			$utente=mysql_fetch_assoc($result);
			echo $utente['username']." ".$_SESSION['user'];
			if($utente['username']!=$_SESSION['user']){
				$username_message="Username già esistente";
				$error=true;
			}
		}
	}

	if($password!="" && strlen($password)<8){
		$password_message="La password deve contenere almeno 8 caratteri";
		$error=true;
	}
	else{
		if($password==""){
			$query="SELECT password FROM utenti WHERE username='{$_SESSION['user']}'";
			$result=mysql_query($query);
			$utente=mysql_fetch_assoc($result);
			$password=$utente['password'];
		}
		else{
			$password=md5($password);
		}
	}

	if($error){
		$class="error";
		$base_path="../dtml/user/";
		$base=new Template($base_path."base.html");
		$login=new Template($base_path."login.html");
		$login->setContent("USERNAME", $_SESSION['user']);
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."updateProfile_form.html");
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
				
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();
	}
	else{
		if(!mysql_query("UPDATE utenti SET nome='{$name}',cognome='{$surname}',email='{$email}',username='{$username}',password='{$password}'
		WHERE username='{$_SESSION['user']}'")){			   
			echo(mysql_error());
		}
		else{
			header("Location:../index.php");
		}
	}

?>