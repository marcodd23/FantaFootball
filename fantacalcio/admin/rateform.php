<?php
include '../include/template.inc.php';
include '../include/auth.inc.php';
include '../include/resultMaker.inc.php';
include '../include/statMaker.inc.php';


//checkAuthorization("admin/teamform.php");

$base=new Template("../dtml/admin/base.html");
$menu=new Template("../dtml/admin/menu_admin.html");
$menu->setContent("RATE", "active");

$content= new Template("../dtml/admin/rateform.html");
if(isset($_GET['action'])){
	$giornata=$_REQUEST['day'];	
	$action=$_GET['action'];
	$players_id=array();
	$result=mysql_query("SELECT * FROM giocatori");
	while ($giocatore=mysql_fetch_assoc($result)){
		$players_id[]=$giocatore['id'];
	}
	//var_dump($players_id);
	switch ($action){
		case 'add':
			foreach ($players_id as $player_id){
				if($_REQUEST['rate_'.$player_id]!="") $rate=$_REQUEST['rate_'.$player_id];
				else $rate=0;
				if($_REQUEST['gf_'.$player_id]!="") $gf=$_REQUEST['gf_'.$player_id];
				else $gf=0;
				if($_REQUEST['gs_'.$player_id]!="") $gs=$_REQUEST['gs_'.$player_id];
				else $gs=0;
				if($_REQUEST['ass_'.$player_id]!="") $ass=$_REQUEST['ass_'.$player_id];
				else $ass=0;
				if($_REQUEST['ag_'.$player_id]!="") $ag=$_REQUEST['ag_'.$player_id];
				else $ag=0;
				if(isset($_REQUEST['amm_'.$player_id])) $amm=$_REQUEST['amm_'.$player_id];
				else $amm=0;
				if(isset($_REQUEST['esp_'.$player_id])) $esp=$_REQUEST['esp_'.$player_id];
				else $esp=0;
				if($_REQUEST['rp_'.$player_id]!="") $rp=$_REQUEST['rp_'.$player_id];
				else $rp=0;
				if($_REQUEST['rs_'.$player_id]!="") $rs=$_REQUEST['rs_'.$player_id];
				else $rs=0;
				if(isset($_REQUEST['gp_'.$player_id])) $gp=$_REQUEST['gp_'.$player_id];
				else $gp=0;
				if(isset($_REQUEST['gv_'.$player_id])) $gv=$_REQUEST['gv_'.$player_id];
				else $gv=0;
// 				echo "<br>INSERT INTO voti (giocatore, giornata, voto, gol_fatto, gol_subito, assist, autogol, ammonizione, espulsione, rigore_parato, rigore_sbagliato, gol_partita, gol_pareggio)
// 				VALUES({$player_id},{$giornata},{$rate},{$gf},{$gs},{$ass},{$ag},{$amm},{$esp},{$rp},{$rs},{$gv},{$gp}";
				$error=false;
				
				if(!mysql_query("INSERT INTO voti (giocatore, giornata, voto, gol_fatto, gol_subito, assist, autogol, ammonizione, espulsione, rigore_parato, rigore_sbagliato, gol_partita, gol_pareggio) 
						VALUES({$player_id},{$giornata},{$rate},{$gf},{$gs},{$ass},{$ag},{$amm},{$esp},{$rp},{$rs},{$gv},{$gp})")){
					$error=true;
				}
				updateStat($rate, $player_id);
				
			}
			if(!$error){
				mysql_query("UPDATE serie_a SET giornata={$giornata} WHERE id=1");
				header("Location:rates.php");
			} 
			updateResult();
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
// if(isset($_GET['id'])){
// 	$id=$_GET['id'];
// 	$squadre=mysql_query("SELECT * FROM squadre WHERE id ='{$id}'");
// 	if(mysql_num_rows($squadre)!=0)
// 		$form_action="update";
// 	$squadra=mysql_fetch_assoc($squadre);	
// 	$id=$squadra['id'];
// 	$nome=$squadra['nome'];
// 	$giocatori=mysql_query("SELECT * FROM giocatori WHERE squadra='{$id}' ");
// 	while($giocatore=mysql_fetch_assoc($giocatori)){
// 		$content->setContent("ID_GIOCATORE", $giocatore['id']);
// 		$content->setContent("NOME_GIOCATORE", $giocatore['nome']);
// 		$content->setContent("COGNOME", $giocatore['cognome']);
// 	}
// }
// $content->setContent("ID", $id);
// $content->setContent("NOME", $nome);

$result=mysql_query("SELECT * FROM giocatori ORDER BY ruolo, cognome");
while ($giocatore=mysql_fetch_assoc($result)){
	$content->setContent("ID", $giocatore['id']);
	$content->setContent("NOME", $giocatore['cognome']." ".$giocatore['nome']);
	
}
$result=mysql_query("SELECT * from serie_a");
$serie_a=mysql_fetch_assoc($result);
$content->setContent("DAY", $serie_a['giornata']+1);
$content->setContent("ACTION", $form_action);
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->close();
?>