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
		$content=new Template($base_path."players.html");
		$result=mysql_query("SELECT * FROM squadre");
		while ($team=mysql_fetch_assoc($result)) {
			$content->setContent("TEAM_NAME", $team['nome']);
		}
		if(isset($_GET['action'])){
			switch ($_GET['action']){
				case 'create':
					$content->setContent("TITLE", "Crea");
					$content->setContent("LEAGUE_ID", $_GET['league']);
					$content->setContent("USER_ID", $_GET['user']);
					$content->setContent("ROSA_TEXT", "0,");
					break;
				case 'update':
					$team_id=$_GET['id'];
					$content->setContent("TITLE", "Modifica");
					$result=mysql_query("SELECT * FROM partecipazioni WHERE rosa={$team_id}");
					$partecipazione=mysql_fetch_assoc($result);
					$content->setContent("LEAGUE_ID", $partecipazione['lega']);
					$content->setContent("USER_ID", $partecipazione['utente']);
					$content->setContent("TEAM_ID", $team_id);
					$result=mysql_query("SELECT * FROM rose WHERE id={$team_id}");
					$rosa=mysql_fetch_assoc($result);
					$content->setContent("NAME_VALUE", $rosa['nome']);
					$result=mysql_query("SELECT r.nome, g.id, g.nome, g.cognome, role.nome AS ruolo
								FROM rose AS r JOIN (acquisti AS a, giocatori AS g, ruoli AS role)
								ON ( r.id = a.rosa AND g.id = a.giocatore AND role.id = g.ruolo ) 
								WHERE r.id ={$team_id} AND role.nome='por'");
					$player_list=new Template($base_path."team_list.html");
					while($player=mysql_fetch_assoc($result)){
						$player_list->setContent("ID", $player['id']);
						$player_list->setContent("RUOLO", $player['ruolo']);
						$player_list->setContent("COGNOME", $player['cognome']);
						$player_list->setContent("NOME", $player['nome']);
						$rosa_text.=$player['id'].",";
					}
					$content->setContent("PORTIERI", $player_list->get());
					$result=mysql_query("SELECT r.nome, g.id, g.nome, g.cognome, role.nome AS ruolo
							FROM rose AS r JOIN (acquisti AS a, giocatori AS g, ruoli AS role)
							ON ( r.id = a.rosa AND g.id = a.giocatore AND role.id = g.ruolo )
							WHERE r.id ={$team_id} AND role.nome='dif'");
							$player_list=new Template($base_path."team_list.html");
							while($player=mysql_fetch_assoc($result)){
							$player_list->setContent("ID", $player['id']);
							$player_list->setContent("RUOLO", $player['ruolo']);
							$player_list->setContent("COGNOME", $player['cognome']);
							$player_list->setContent("NOME", $player['nome']);
							$rosa_text.=$player['id'].",";
					}
					$content->setContent("DIFENSORI", $player_list->get());
					$result=mysql_query("SELECT r.nome, g.id, g.nome, g.cognome, role.nome AS ruolo
							FROM rose AS r JOIN (acquisti AS a, giocatori AS g, ruoli AS role)
							ON ( r.id = a.rosa AND g.id = a.giocatore AND role.id = g.ruolo )
							WHERE r.id ={$team_id} AND role.nome='cen'");
							$player_list=new Template($base_path."team_list.html");
							while($player=mysql_fetch_assoc($result)){
							$player_list->setContent("ID", $player['id']);
							$player_list->setContent("RUOLO", $player['ruolo']);
							$player_list->setContent("COGNOME", $player['cognome']);
							$player_list->setContent("NOME", $player['nome']);
							$rosa_text.=$player['id'].",";
					}
					$content->setContent("CENTROCAMPISTI", $player_list->get());
					$result=mysql_query("SELECT r.nome, g.id, g.nome, g.cognome, role.nome AS ruolo
							FROM rose AS r JOIN (acquisti AS a, giocatori AS g, ruoli AS role)
							ON ( r.id = a.rosa AND g.id = a.giocatore AND role.id = g.ruolo )
							WHERE r.id ={$team_id} AND role.nome='att'");
							$player_list=new Template($base_path."team_list.html");
							while($player=mysql_fetch_assoc($result)){
							$player_list->setContent("ID", $player['id']);
							$player_list->setContent("RUOLO", $player['ruolo']);
							$player_list->setContent("COGNOME", $player['cognome']);
							$player_list->setContent("NOME", $player['nome']);
							$rosa_text.=$player['id'].",";
					}
					$content->setContent("ATTACCANTI", $player_list->get());
					$content->setContent("ROSA_TEXT", "0,".$rosa_text);
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