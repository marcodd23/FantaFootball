<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';

checkAuthorization("user/league_submit.php");

$username=$_SESSION['user'];
$result=mysql_query("SELECT u.id FROM utenti u WHERE u.username='{$username}'");
$user=mysql_fetch_assoc($result);
$user_id=$user['id'];



$name=trim($_POST['name']);
$teams=trim($_POST['teams']);
$gf=trim($_POST['gf']);
$gs=trim($_POST['gs']);
$assist=trim($_POST['assist']);
$ag=trim($_POST['ag']);
$amm=trim($_POST['amm']);
$esp=trim($_POST['esp']);
$rp=trim($_POST['rp']);
$rs=trim($_POST['rs']);
$gv=trim($_POST['gv']);
$gp=trim($_POST['gp']);

// foreach ($_POST as $value){
// 	echo $value."<br>";
// }
// echo "INSERT INTO regole (gol_fatto,gol_subito,assist,autogol,ammonizione,espulsione,rigore_sbagliato,rigore_parato,gol_partita,gol_pareggio) 
// 					VALUES ({$gf},{$gs},{$assist},{$ag},{$amm},{$esp},{$rs},{$rp},{$gv},{$gp})";
if(isset($_GET['action']))$action=$_GET['action'];

$result=mysql_query("SELECT * FROM regole WHERE id = 1");
$default=mysql_fetch_row($result);
$default_row=false;
$error=false;
//var_dump($_POST);
if(count($_POST)!=0){
	if($name==""){
		$name_message="Il nome è obbligatorio";
		$error=true;
	}
	if($teams=="" || !is_numeric($teams) || $teams<2){
		$teams_message="Il numero di squadre deve essere un numero > 1";
		$error=true;
	}
	if($gf!="" && !is_numeric($gf)){
		$gf_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$gf=$default['gol_fatto'];
		$default_row=true;
	}
	if($gs!="" && !is_numeric($gs)){
		$gs_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$gs=$default['gol_subito'];
		$default_row=true;
	}
	if($assist!="" && !is_numeric($assist)){
		$assist_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$assist=$default['assist'];
		$default_row=true;
	}
	if($ag!="" && !is_numeric($ag)){
		$ag_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$ag=$default['autogol'];
		$default_row=true;
	}
	if($amm!="" && !is_numeric($amm)){
		$amm_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$amm=$default['ammonizione'];
		$default_row=true;
	}
	if($esp!="" && !is_numeric($esp)){
		$esp_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$esp=$default['espulsione'];
		$default_row=true;
	}
	if($rp!="" && !is_numeric($rp)){
		$rp_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$rp=$default['rigore_parato'];
		$default_row=true;
	}
	if($rs!="" && !is_numeric($rs)){
		$rs_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$rs=$default['rigore_sbagliato'];
		$default_row=true;
	}
	if($gv!="" && !is_numeric($gv)){
		$gv_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$gv=$default['gol_partita'];
		$default_row=true;
	}
	if($gp!="" && !is_numeric($gp)){
		$gp_message="Il campo deve essere un numero";
		$error=true;
		$default_row=false;
	}
	else{
		$gp=$default['gol_pareggio'];
		$default_row=true;
	}
}
$base_path="../dtml/user/";
var_dump($error);
if($error){
	$base=new Template($base_path."base.html");
	$login=new Template($base_path."login.html");
	$login->setContent("USERNAME", $username);
	$menu=new Template($base_path."menu.html");
	$content=new Template($base_path."league_form.html");
	
	$content->setContent("CLASS", "error");
	
	$content->setContent("NAME_MESSAGE", $name_message);
	$content->setContent("NAME_VALUE", $name);
	
	$content->setContent("TEAMS_MESSAGE", $teams_message);
	$content->setContent("TEAMS_VALUE", $teams);
	
	$content->setContent("GF_MESSAGE", $gf_message);
	$content->setContent("GF_VALUE", $gf);
	
	$content->setContent("GS_MESSAGE", $gs_message);
	$content->setContent("GS_VAUE", $gs);
	
	$content->setContent("AG_MESSAGE", $ag_message);
	$content->setContent("AG_VALUE", $ag);
	
	$content->setContent("ASSIST_MESSAGE", $assist_message);
	$content->setContent("ASSIST_VALUE", $assist);
	
	$content->setContent("AMM_MESSAGE", $amm_message);
	$content->setContent("AMM_VALUE", $amm);
	
	$content->setContent("ESP_MESSAGE", $esp_message);
	$content->setContent("ESP_VALUE", $esp);
	
	$content->setContent("RP_MESSAGE", $rp_message);
	$content->setContent("RP_VALUE", $rp);
	
	$content->setContent("RS_MESSAGE", $rs_message);
	$content->setContent("RS_VALUE", $rs);
	
	$content->setContent("GV_MESSAGE", $gv_message);
	$content->setContent("GV_VALUE", $gv);
	
	$content->setContent("GP_MESSAGE", $gp_message);
	$content->setContent("GP_VALUE", $gp);
	
	$content->setContent("ACTION",$action);
	$footer=new Template($base_path."footer.html");
	
	$base->setContent("LOGIN", $login->get());
	$base->setContent("MENU", $menu->get());
	$base->setContent("CONTENT", $content->get());
	$base->setContent("FOOTER", $footer->get());
	$base->close();
	exit();
}
else{
switch ($action){
	case 'create':
		//echo $default_row;
		$error="";
		if($default_row)$id=1;
		else{
			if(mysql_query("INSERT INTO regole (gol_fatto,gol_subito,assist,autogol,ammonizione,espulsione,rigore_sbagliato,rigore_parato,gol_partita,gol_pareggio) 
					VALUES ({$gf},{$gs},{$assist},{$ag},{$amm},{$esp},{$rs},{$rp},{$gv},{$gp});"));
			else($error=mysql_error()."<br>");
			$id=mysql_insert_id();
		}
		$result=mysql_query("SELECT * FROM serie_a");
		$serie_a=mysql_fetch_assoc($result);
		$inizio=$serie_a['giornata'];
		if(!mysql_query("INSERT INTO leghe (nome,partecipanti,regolamento, inizio) VALUES ('{$name}',{$teams},{$id},{$inizio})"))
			$error.="Inserimento lega: ".mysql_error()."<br>";
		else $id_lega=mysql_insert_id();
		//echo "INSERT INTO partecipazioni (utente, lega, rosa, ruolo) VALUES ({$user_id},{$id_lega},null,2)<br>";
		if(!mysql_query("INSERT INTO partecipazioni (utente, lega, rosa, ruolo) VALUES ({$user_id},{$id_lega},null,2)"))
			$error.="Inserimento partecipazione: ".mysql_error()."<br>";
		if($error!="")echo $error;
		else header("Location:league.php?id=".$id_lega);
		break;
	case 'delete':
		mysql_query("DELETE FROM leghe WHERE id={$_GET['id']}");
		header("Location:../index.php");
		break;
	}
}

?>