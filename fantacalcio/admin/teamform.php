<?php
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/teamform.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("TEAM", "active");

$content= new Template("../dtml/admin/teamform.html");
if(isset($_GET['action'])){
	$id=$_REQUEST['id_hidden'];
	$nome=$_REQUEST['nome'];
	
	$action=$_GET['action'];
	switch ($action){
		case 'add':
			if(!mysql_query("INSERT INTO squadre (nome) VALUES('{$nome}')")){			   
				echo(mysql_error());
			}
			else header("Location:teams.php");
			break;
		case 'update':
			if(!mysql_query("UPDATE squadre SET nome='{$nome}' WHERE id='{$id}'")){
				echo mysql_error();
			}
			else header("Location:teams.php");
			break;
		case 'delete':
			$id=$_GET['id'];
			if(!mysql_query("DELETE FROM squadre WHERE id='{$id}'")){
				echo mysql_error();
			}
			else header("Location:teams.php");
			break;
	}
}
$form_action="add";
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$squadre=mysql_query("SELECT * FROM squadre WHERE id ='{$id}'");
	if(mysql_num_rows($squadre)!=0)
		$form_action="update";
	$squadra=mysql_fetch_assoc($squadre);	
	$id=$squadra['id'];
	$nome=$squadra['nome'];
	$giocatori=mysql_query("SELECT * FROM giocatori WHERE squadra='{$id}' ");
	while($giocatore=mysql_fetch_assoc($giocatori)){
		$content->setContent("ID_GIOCATORE", $giocatore['id']);
		$content->setContent("NOME_GIOCATORE", $giocatore['nome']);
		$content->setContent("COGNOME", $giocatore['cognome']);
	}
}
$content->setContent("ID", $id);
$content->setContent("NOME", $nome);


$content->setContent("ACTION", $form_action);
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();
?>