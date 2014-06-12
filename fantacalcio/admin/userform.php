<?php
//echo $_SERVER['HTTP_REFERER'];
//echo substr($_SERVER['HTTP_REFERER'], 45);
//echo substr($_SERVER['HTTP_REFERER'],0,45);
include '../include/template.inc.php';
include '../include/auth.inc.php';

checkAuthorization("admin/userform.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("USER", "active");

$content= new Template("../dtml/admin/userform.html");
$content->setContent("PROVENIENZA", $_SERVER['HTTP_REFERER']);
if(isset($_GET['action'])){
	$provenienza=$_REQUEST['provenienza'];
	$id=$_REQUEST['id_hidden'];
	$nome=$_REQUEST['nome'];
	$cognome=$_REQUEST['cognome'];
	$email=$_REQUEST['email'];
	$username=$_REQUEST['username'];
	$password=$_REQUEST['password'];
	$gruppo=$_REQUEST['gruppo'];
	$action=$_GET['action'];
	switch ($action){
		case 'add':
			if(!mysql_query("INSERT INTO utenti (nome,cognome,email,username,password,gruppo)VALUES('{$nome}','{$cognome}','{$email}','{$username}','{$password}','{$gruppo}')")){			   
				echo(mysql_error());
			}
			else{
				header("Location:".$provenienza);
			}
			break;
		case 'update':
			if(!mysql_query("UPDATE utenti SET nome='{$nome}',cognome='{$cognome}',email='{$email}',username='{$username}',password='{$password}',gruppo='{$gruppo}' WHERE id='{$id}'")){
				echo mysql_error();
			}
			else{
				header("Location:".$provenienza);
			}
			break;
		case 'delete':
			$id=$_GET['id'];
			if(!mysql_query("DELETE FROM utenti WHERE id='{$id}'")){
				echo mysql_error();
			}
			else header("Location:users.php");
			break;
	}
}
$form_action="add";
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$utenti=mysql_query("SELECT u.id AS id, u.nome AS nome, u.cognome AS cognome, 
			u.email AS email,u.username as username, u.password AS password, g.nome as gruppo,
			g.id as id_gruppo
			FROM utenti AS u, gruppi AS g
WHERE u.id ='{$id}' AND u.gruppo = g.id");
	if(mysql_num_rows($utenti)!=0)
		$form_action="update";
	$utente=mysql_fetch_assoc($utenti);	
	$id=$utente['id'];
	$nome=$utente['nome'];
	$cognome=$utente['cognome'];
	$email=$utente['email'];
	$username=$utente['username'];
	$password=$utente['password'];
	$gruppo_selected=$utente['id_gruppo'];
}
if(substr($_SERVER['HTTP_REFERER'],0,45)=="http://localhost/fantacalcio/admin/userform.php?id="){
	$squadra_selected=substr($_SERVER['HTTP_REFERER'], 45);
}
$content->setContent("ID", $id);
$content->setContent("NOME", $nome);
$content->setContent("COGNOME", $cognome);
$content->setContent("EMAIL", $email);
$content->setContent("USERNAME", $username);
$content->setContent("PASSWORD", $password);


$query="SELECT * FROM gruppi ORDER BY nome";
$gruppi=mysql_query($query);
$i=0;
while ($gruppo=mysql_fetch_assoc($gruppi)) {
	$data[$i][value] = $gruppo['id'];
	$data[$i][text] = $gruppo['nome'];
	$i++;
}
$select_gruppi=new Render();
$content->setContent("SELECT_GRUPPO", $select_gruppi->Select("gruppo", $data,'id="inputGruppo"',$gruppo_selected));
$content->setContent("ACTION", $form_action);
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();
?>