<?php
//echo $_SERVER['HTTP_REFERER'];
//echo substr($_SERVER['HTTP_REFERER'], 45);
//echo substr($_SERVER['HTTP_REFERER'],0,45);
include '../include/template.inc.php';
include '../include/auth.inc.php';

//checkAuthorization("admin/playerform.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("MATCH", "active");

$content= new Template("../dtml/admin/matchform.html");
$content->setContent("PROVENIENZA", $_SERVER['HTTP_REFERER']);
if(isset($_GET['action'])){
	$provenienza=$_REQUEST['provenienza'];
	$id=$_REQUEST['id_hidden'];
	$squadra_casa=$_REQUEST['squadra_casa'];
	$squadra_trasferta=$_REQUEST['squadra_trasferta'];
	$action=$_GET['action'];
	switch ($action){
		case 'add':
			if(!mysql_query("INSERT INTO partite_serie_a (squadra_casa,squadra_trasferta)VALUES({$squadra_casa},{$squadra_trasferta})")){			   
				echo(mysql_error());
			}
			else{
				header("Location:".$provenienza);
			}
			break;
		case 'update':
			if(!mysql_query("UPDATE partite_serie_a SET squadra_trasferta={$squadra_trasferta},
							squadra_casa={$squadra_casa} WHERE id={$id}")){
				echo mysql_error();
			}
			else{
				header("Location:".$provenienza);
			}
			break;
		case 'delete':
			$id=$_GET['id'];
			if(!mysql_query("DELETE FROM partite_serie_a WHERE id='{$id}'")){
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
	$squadre=mysql_query("SELECT * from partite_serie_a");
	if(mysql_num_rows($squadre)!=0)
		$form_action="update";
	$squadra=mysql_fetch_assoc($squadre);	
	$squadra_casa_selected=$squadra['squadra_casa'];
	$squadra_trasferta_selected=$squadra['squadra_trasferta'];
}
if(substr($_SERVER['HTTP_REFERER'],0,46)=="http://localhost/fantacalcio/admin/matchform.php?id="){
	$squadra_selected=substr($_SERVER['HTTP_REFERER'], 45);
}
$content->setContent("ID", $id);

$query="SELECT * FROM squadre ORDER BY nome";
$squadre=mysql_query($query);
$i=0;
while ($squadra=mysql_fetch_assoc($squadre)) {
	$data[$i][value] = $squadra['id'];
	$data[$i][text] = $squadra['nome'];
	$i++;
}
$select_squadre=new Render();
$content->setContent("SELECT_SQUADRE_CASA", $select_squadre->Select("squadra_casa", $data,'id="inputSquadraCasa"',$squadra_casa_selected));


$select_squadre=new Render();
$content->setContent("SELECT_SQUADRE_TRASFERTA", $select_squadre->Select("squadra_trasferta", $data,'id="inputSquadraTrasferta"',$squadra_trasferta_selected));


$content->setContent("ACTION", $form_action);
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();
?>