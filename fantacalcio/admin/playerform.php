<?php
//echo $_SERVER['HTTP_REFERER'];
//echo substr($_SERVER['HTTP_REFERER'], 45);
//echo substr($_SERVER['HTTP_REFERER'],0,45);
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/playerform.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("PLAYER", "active");

$content= new Template("../dtml/admin/playerform.html");
$content->setContent("PROVENIENZA", $_SERVER['HTTP_REFERER']);
if(isset($_GET['action'])){
	$provenienza=$_REQUEST['provenienza'];
	$id=$_REQUEST['id_hidden'];
	$nome=$_REQUEST['nome'];
	$cognome=mysql_real_escape_string($_REQUEST['cognome']);
	$quotazione=$_REQUEST['quotazione'];
	$ruolo=$_REQUEST['ruolo'];
	$squadra=$_REQUEST['squadra'];
	$action=$_GET['action'];
	switch ($action){
		case 'add':
			if(!mysql_query("INSERT INTO giocatori (nome,cognome,quotazione,ruolo,squadra)VALUES('{$nome}','{$cognome}','{$quotazione}','{$ruolo}','${squadra}')")){			   
				echo(mysql_error());
			}
			else{
				header("Location:".$provenienza);
			}
			break;
		case 'update':
			if(!mysql_query("UPDATE giocatori SET nome='{$nome}',cognome='{$cognome}',quotazione='{$quotazione}',ruolo='{$ruolo}',squadra='{$squadra}' WHERE id='{$id}'")){
				echo mysql_error();
			}
			else{
				header("Location:".$provenienza);
			}
			break;
		case 'delete':
			$id=$_GET['id'];
			if(!mysql_query("DELETE FROM giocatori WHERE id='{$id}'")){
				echo mysql_error();
			}
			else {
				$provenienza=  $_SERVER['HTTP_REFERER'];
				header("Location:".$provenienza);
			}
			
			break;
	}
}
$form_action="add";
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$giocatori=mysql_query("SELECT g.id AS id, g.nome AS nome, g.cognome AS cognome, g.quotazione AS quotazione,r.id as id_ruolo, r.nome AS ruolo, s.id as id_squadra,s.nome AS squadra
FROM giocatori AS g, squadre AS s, ruoli AS r
WHERE g.id ='{$id}'
AND g.ruolo = r.id
AND g.squadra = s.id");
	if(mysql_num_rows($giocatori)!=0)
		$form_action="update";
	$giocatore=mysql_fetch_assoc($giocatori);	
	$id=$giocatore['id'];
	$nome=$giocatore['nome'];
	$cognome=$giocatore['cognome'];
	$quotazione=$giocatore['quotazione'];
	$ruolo_selected=$giocatore['id_ruolo'];
	$squadra_selected=$giocatore['id_squadra'];
}
if(substr($_SERVER['HTTP_REFERER'],0,45)=="http://localhost/fantacalcio/admin/teamform.php?id="){
	$squadra_selected=substr($_SERVER['HTTP_REFERER'], 45);
}
$content->setContent("ID", $id);
$content->setContent("NOME", $nome);
$content->setContent("COGNOME", $cognome);
$content->setContent("QUOTAZIONE", $quotazione);

$query="SELECT * FROM ruoli";
$ruoli=mysql_query($query);
$i=0;
while ($ruolo=mysql_fetch_assoc($ruoli)) {
	$data[$i][value]= $ruolo['id'];
	$data[$i][text]= $ruolo['nome'];
	$i++;
}
$select_ruoli=new Render();
$content->setContent("SELECT_RUOLI", $select_ruoli->Select("ruolo", $data,'id="inputRuolo"',$ruolo_selected));

$query="SELECT * FROM squadre ORDER BY nome";
$squadre=mysql_query($query);
$i=0;
while ($squadra=mysql_fetch_assoc($squadre)) {
	$data[$i][value] = $squadra['id'];
	$data[$i][text] = $squadra['nome'];
	$i++;
}
$select_squadre=new Render();
$content->setContent("SELECT_SQUADRE", $select_squadre->Select("squadra", $data,'id="inputSquadra"',$squadra_selected));
$content->setContent("ACTION", $form_action);
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();
?>