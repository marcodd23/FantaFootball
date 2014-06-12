<?php
//echo $_SERVER['HTTP_REFERER'];
//echo substr($_SERVER['HTTP_REFERER'], 45);
//echo substr($_SERVER['HTTP_REFERER'],0,45);
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/serviceform.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("SERVICE", "active");

$content= new Template("../dtml/admin/serviceform.html");
$content->setContent("PROVENIENZA", $_SERVER['HTTP_REFERER']);
if(isset($_GET['action'])){
	$provenienza=$_REQUEST['provenienza'];
	$id=$_REQUEST['id_hidden'];
	$nome=$_REQUEST['nome'];
	$azione=$_REQUEST['azione'];
	$gruppi=array();
	$gruppi=$_REQUEST['gruppo'];
	$action=$_GET['action'];
	switch ($action){
		case 'add':
			if(!mysql_query("INSERT INTO servizi (nome,azione)VALUES('{$nome}','{$azione}')")){	
				echo(mysql_error());
			}
			else{
				$last_id=mysql_insert_id();
				foreach ($gruppi as $gruppo)
				mysql_query("INSERT INTO permessi (servizio,gruppo) VALUES ('{$last_id}','{$gruppo}')");
				header("Location:".$provenienza);
			}
			break;
		case 'update':
			if(!mysql_query("UPDATE servizi SET nome='{$nome}',azione='{$azione}' WHERE id='{$id}'")){
				echo mysql_error();
			}
			else{
				//cancello le associazioni e poi le rimetto da capo perché se deseleziono un gruppo
				//in realtà sto cancellando una riga della tabella permessi
				mysql_query("DELETE FROM permessi WHERE servizio = '{$id}'");
				foreach ($gruppi as $gruppo){
					mysql_query("INSERT INTO permessi (servizio,gruppo) VALUES ('{$id}','{$gruppo}')");
				}
				//mysql_query("UPDATE permessi SET gruppo='{$gruppo}' WHERE servizio='{$id}'");
				header("Location:".$provenienza);
			}
			break;
		case 'delete':
			$id=$_GET['id'];
			if(!mysql_query("DELETE FROM servizi WHERE id='{$id}'")){
				echo mysql_error();
			}
			else {
				$provenienza=  $_SERVER['HTTP_REFERER'];
				header("Location:".$provenienza);
			}
			
			break;
	}
}

$gruppo_checked=array();
$gruppi=mysql_query("SELECT * FROM gruppi");
while ($gruppo=mysql_fetch_assoc($gruppi)) {
	$index=$gruppo['nome'];
	$gruppo_checked[$index]=false;
}

$form_action="add";
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$servizi=mysql_query("SELECT s.id AS id, s.nome AS nome, s.azione AS azione, g.id as id_gruppo,g.nome as gruppo
FROM servizi AS s, permessi AS p,  gruppi AS g
WHERE s.id ='{$id}'
AND s.id = p.servizio
AND g.id = p.gruppo");
	if(mysql_num_rows($servizi)!=0)
		$form_action="update";
	while($permesso=mysql_fetch_assoc($servizi)){	
	$id=$permesso['id'];
	$nome=$permesso['nome'];
	$azione=$permesso['azione'];
	$index=$permesso['gruppo'];
	//echo $index."<br>";
	$gruppo_checked[$index]=true;
	
	}
}

$content->setContent("ID", $id);
$content->setContent("NOME", $nome);
$content->setContent("AZIONE", $azione);

$gruppi=mysql_query("SELECT * FROM gruppi");
while ($gruppo=mysql_fetch_assoc($gruppi)) {

	$content->setContent("ID_GRUPPO", $gruppo['id']);
	$content->setContent("NOME_GRUPPO", $gruppo['nome']);
	$index=$gruppo['nome'];
	if($gruppo_checked[$index]){
 			$content->setContent("CHECKED", "checked");
	}
	else{
		$content->setContent("CHECKED", "");
	}	
}

$content->setContent("ACTION", $form_action);
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();
?>