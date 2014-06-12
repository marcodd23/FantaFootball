<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';

//checkAuthorization("user/league.php");

$username=$_SESSION['user'];

if(isset($_GET['id'])){
	$id_rosa=$_GET['id'];
	$result=mysql_query("SELECT r.nome AS nome_rosa, u.username as allenatore, g.nome, g.cognome,ruoli.descrizione as ruolo,s.nome as squadra,p.lega
						FROM rose AS r JOIN (acquisti AS a, giocatori AS g,ruoli,squadre as s,partecipazioni as p, utenti as u) 
						ON ( r.id = a.rosa AND a.giocatore = g.id AND g.ruolo=ruoli.id AND g.squadra = s.id AND r.id=p.rosa AND p.utente=u.id) 
						WHERE a.rosa =${id_rosa}");
	if(mysql_num_rows($result)==0){
		header("Location:../error.php?code=500");
		exit();
	}
	$base_path="../dtml/user/";
	$base=new Template($base_path."base.html");
	$login=new Template($base_path."login.html");
	$login->setContent("USERNAME", $username);
	$menu=new Template($base_path."menu.html");
	$content= new Template($base_path."team_views.html");
	$lega_result=mysql_query("SELECT *
			FROM partecipazioni JOIN utenti ON (partecipazioni.utente=utenti.id) 
			WHERE rosa =${id_rosa}");
	$lega=mysql_fetch_assoc($lega_result);
	$content->setContent("LEAGUE_ID", $lega['lega']);
	if(isLeagueAdmin($lega['lega'], $username)){
		$content->setContent("MODIFICA_ROSA", "<a href=\"team_start.php?action=update&id=".$id_rosa."\" style=\"float: right;\" title=\"Modifica rosa\"><i class=\"icon-pencil\"></i></a>");
	}
	while ($player=mysql_fetch_assoc($result)){
		$content->setContent("NOME_ROSA", $player['nome_rosa']);
		$content->setContent("ALLENATORE", $player['allenatore']);
		$content->setContent("COGNOME", $player['cognome']);
		$content->setContent("NOME", $player['nome']);
		$content->setContent("RUOLO", $player['ruolo']);
		$content->setContent("SQUADRA", $player['squadra']);
	}
	$footer=new Template($base_path."footer.html");
	
	$base->setContent("LOGIN", $login->get());
	$base->setContent("MENU", $menu->get());
	$base->setContent("CONTENT", $content->get());
	$base->setContent("FOOTER", $footer->get());
	$base->close();
	}
else{
	header("Location:../error.php?code=500");
}	
?>