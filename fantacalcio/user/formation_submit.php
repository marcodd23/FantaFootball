<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';

$module=$_POST['module'];
$titolari=explode(",", $_POST['rosa_text']);
$riserve=explode(",", $_POST['riserve_text']);

$rosa=$_POST['rosa'];
$match=$_POST['match'];

var_dump($_POST);
var_dump($titolari);
var_dump($riserve);

switch ($_GET['action']){
	case 'create':
// 		if(!mysql_query("INSERT INTO rose (nome) VALUES('{$team_name}')"))echo mysql_error();
// 		$rosa_id=mysql_insert_id();
		for ($i=1;$i<count($titolari)-1;$i++){
			$numero=$i;
			//echo $numero;
			if(!mysql_query("INSERT INTO formazioni (partita, rosa, giocatore, numero) 
 					VALUES ({$match},{$rosa},{$titolari[$i]},{$numero})"))echo mysql_error();
		}
		for ($i=1;$i<count($riserve)-1;$i++){
			$numero=11+$i;
			//echo $numero;
			if(!mysql_query("INSERT INTO formazioni (partita, rosa, giocatore, numero)
					VALUES ({$match},{$rosa},{$riserve[$i]},{$numero})"))echo mysql_error();
		}
		//if(!mysql_query("UPDATE partecipazioni SET rosa={$rosa_id} WHERE utente={$user} AND lega={$league}"))echo mysql_error();
		break;
	case 'update':
// 		if(!mysql_query("DELETE FROM rose WHERE id={$team_id}"))echo mysql_error();
// 		if(!mysql_query("INSERT INTO rose (nome) VALUES('{$team_name}')"))echo mysql_error();
// 		$rosa_id=mysql_insert_id();
// 		for ($i=0;$i<count($team)-1;$i++){
// 			if(!mysql_query("INSERT INTO acquisti (giocatore, rosa) VALUES ({$team[$i]},{$rosa_id})"))echo mysql_error();
// 		}
// 		if(!mysql_query("UPDATE partecipazioni SET rosa={$rosa_id} WHERE utente={$user} AND lega={$league}"))echo mysql_error();
// 		break;
}
$result=mysql_query("SELECT * FROM partite WHERE id={$match}");
$day=mysql_fetch_assoc($result);
header("Location:day.php?id=".$day['giornata']);
?>