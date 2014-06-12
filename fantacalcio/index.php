<?php
require './include/template2.inc.php';
require './include/auth.inc.php';

	$base_path="./dtml/";
	
	$base=new Template($base_path."base.html");
	
	if(isLogged()){
		$username=$_SESSION['user'];
		$base_path_user="./dtml/user/";
		$login=new Template($base_path_user."login.html");
		$login->setContent("USERNAME", $username);
		$content=new Template($base_path_user."home.html");
		$result = mysql_query("SELECT l.id, l.nome,l.partecipanti, g.nome AS gruppo
				FROM leghe as l JOIN (partecipazioni AS p,utenti AS u,gruppi AS g) ON (l.id=p.lega AND u.id=p.utente AND g.id=p.ruolo)
				WHERE u.username='{$username}'");
		if(mysql_num_rows($result)==0)
			$section=new Template($base_path_user."home_section1_false.html");
		else{
			$section=new Template($base_path_user."home_section1_true.html");
			while ($leghe=mysql_fetch_assoc($result)){
				$section->setContent("NOME", $leghe['nome']);
				$section->setContent("SQUADRE", $leghe['partecipanti']);
				if($leghe['gruppo']=="lega_admin"){
					$section->setContent("RUOLO", "Amministratore");
					$actions=new Template($base_path_user."league_actions_admin.html");
				}
				else {
					$section->setContent("RUOLO", "Utente semplice");
					$actions=new Template($base_path_user."league_actions_user.html");
				}
				$actions->setContent("ID", $leghe['id']);
				$section->setContent("ACTIONS", $actions->get());
			}
		}
		$content->setContent("SECTION1", $section->get());
		
		$section=new Template($base_path_user."home_section2.html");
		$result=mysql_query("SELECT * FROM utenti WHERE username='$username'");
		$user=mysql_fetch_assoc($result);
		$section->setContent("NOME", $user['nome']);
		$section->setContent("COGNOME", $user['cognome']);
		$section->setContent("EMAIL", $user['email']);
		$section->setContent("USERNAME", $user['username']);		
		$content->setContent("SECTION2", $section->get());
		
		$result = mysql_query("SELECT * FROM leghe JOIN (partecipazioni,utenti)
				ON (leghe.id=partecipazioni.lega AND partecipazioni.utente=utenti.id) 
				WHERE utenti.username='{$username}' AND leghe.nome='Fantaweb'");
		if(mysql_num_rows($result)==0)
			$section=new Template($base_path_user."home_section3_false.html");
		else{
			$section=new Template($base_path_user."home_section3_true.html");
			while ($leghe=mysql_fetch_assoc($result)){

			}
		}
		$content->setContent("SECTION3", $section->get());
	}
	else{
		$login=new Template($base_path."login.html");
		$content=new Template($base_path."home.html");
		$slider=new Template($base_path."slider.html");
		$base->setContent("SLIDER", $slider->get());
	}
	$menu=new Template($base_path."menu.html");
	$footer=new Template($base_path."footer.html");

	$base->setContent("LOGIN", $login->get());
	$base->setContent("MENU", $menu->get());
	$base->setContent("CONTENT", $content->get());
	$base->setContent("FOOTER", $footer->get());
	$base->close();

?>