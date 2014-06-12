<?php
//echo $_SERVER['HTTP_REFERER'];
//echo substr($_SERVER['HTTP_REFERER'], 45);
//echo substr($_SERVER['HTTP_REFERER'],0,45);
include '../include/template.inc.php';
include '../include/auth.inc.php';

//checkAuthorization("admin/userform.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("PROB", "active");

$content= new Template("../dtml/admin/prob_formform.html");
$content->setContent("PROVENIENZA", $_SERVER['HTTP_REFERER']);
if(isset($_GET['action'])){
	$provenienza=$_REQUEST['provenienza'];
	$id_team=$_REQUEST['id_hidden'];
	$giocatori=$_REQUEST['giocatori'];
	$action=$_GET['action'];
	mysql_query("DELETE FROM probabili_formazioni WHERE squadra={$id_team}");
	switch ($action){
		case 'add':
			foreach ($giocatori as $id){
				if(!mysql_query("INSERT INTO probabili_formazioni (giocatore,squadra) VALUES ({$id},{$id_team})"))
				$error="<br>".mysql_error()."<br>";
			}
			if($error!="")
				echo $error;
			else{
				header("Location:".$provenienza);
			}
			//var_dump($giocatori);
			break;
// 		case 'update':
// 			if(!mysql_query("UPDATE utenti SET nome='{$nome}',cognome='{$cognome}',email='{$email}',username='{$username}',password='{$password}',gruppo='{$gruppo}' WHERE id='{$id}'")){
// 				echo mysql_error();
// 			}
// 			else{
// 				header("Location:".$provenienza);
// 			}
// 			break;
// 		case 'delete':
// 			$id=$_GET['id'];
// 			if(!mysql_query("DELETE FROM utenti WHERE id='{$id}'")){
// 				echo mysql_error();
// 			}
// 			else header("Location:users.php");
// 			break;
	}
}
$form_action="add";
if(isset($_GET['team'])){
	$id=$_GET['team'];
	$result=mysql_query("SELECT g.*, s.nome as squadra FROM giocatori as g JOIN squadre as s
			ON (g.squadra=s.id)
			WHERE s.id ='{$id}' ORDER BY ruolo");
// 	if(mysql_num_rows($utenti)!=0)
// 		$form_action="update";
	$squadra=mysql_fetch_assoc($result);
	$content->setContent("SQUADRA", $squadra['squadra']);
	mysql_data_seek($result, 0);
	while($giocatori=mysql_fetch_assoc($result)){
		$content->setContent("ID", $giocatori['id']);
		$content->setContent("NOME", $giocatori['cognome']." ".$giocatori['nome']);
		//echo "SELECT * from probabili_formazioni WHERE squadra={$id} AND giocatore={$giocatori['id']}";		
		if(!mysql_num_rows(mysql_query("SELECT * from probabili_formazioni WHERE squadra={$id} AND giocatore={$giocatori['id']}")))
			$content->setContent("CHECKED", "");
		else $content->setContent("CHECKED", "checked");
	}	
	$content->setContent("ID_SQUADRA", $_GET['team']);
}

$content->setContent("ACTION", $form_action);
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();
?>