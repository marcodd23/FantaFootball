<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';

$team_name=$_POST['name'];
$team=explode(",", $_POST['rosa']);
$league=$_POST['league'];
$user=$_POST['user'];
$team_id=$_POST['team_id'];
echo $league."<br>";
echo $user."<br>";
echo $team_name."<br>";
echo count($team)."<br>";
foreach ($team as $value){
	echo $value."<br>";
}
switch ($_GET['action']){
	case 'create':
		if(!mysql_query("INSERT INTO rose (nome) VALUES('{$team_name}')"))echo mysql_error();
		$rosa_id=mysql_insert_id();
		for ($i=1;$i<count($team)-1;$i++){
			if(!mysql_query("INSERT INTO acquisti (giocatore, rosa) VALUES ({$team[$i]},{$rosa_id})"))echo mysql_error();
		}
		if(!mysql_query("UPDATE partecipazioni SET rosa={$rosa_id} WHERE utente={$user} AND lega={$league}"))echo mysql_error();
		break;
	case 'update':
		if(!mysql_query("DELETE FROM rose WHERE id={$team_id}"))echo mysql_error();
		if(!mysql_query("INSERT INTO rose (nome) VALUES('{$team_name}')"))echo mysql_error();
		$rosa_id=mysql_insert_id();
		for ($i=1;$i<count($team)-1;$i++){
			if(!mysql_query("INSERT INTO acquisti (giocatore, rosa) VALUES ({$team[$i]},{$rosa_id})"))echo mysql_error();
		}
		if(!mysql_query("UPDATE partecipazioni SET rosa={$rosa_id} WHERE utente={$user} AND lega={$league}"))echo mysql_error();
		break;
}
header("Location:team.php?id=".$rosa_id);
?>