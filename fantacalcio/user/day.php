<?php

include '../include/template2.inc.php';
include '../include/auth.inc.php';
include '../include/service.inc.php';

$day=$_GET['id'];

//checkAuthorization("user/league_start.php");

$base_path="../dtml/user/";
$base=new Template($base_path."base.html");
$login=new Template($base_path."login.html");
$login->setContent("USERNAME", $_SESSION['user']);
$menu=new Template($base_path."menu.html");
$content=new Template($base_path."day_views.html");

$query_day="SELECT partite. * , giornate.numero, giornate.lega, r1.nome AS nome_casa, r2.nome AS nome_trasferta, 
					leghe.id as id_lega,leghe.nome, leghe.partecipanti, leghe.inizio, r.gol_fatto,r.gol_subito,r.autogol,r.assist,
					r.ammonizione,r.espulsione,r.rigore_parato,r.rigore_sbagliato,r.gol_partita,r.gol_pareggio
					FROM partite
					LEFT JOIN rose AS r1 ON r1.id = partite.squadra_casa
					LEFT JOIN rose AS r2 ON r2.id = partite.squadra_trasferta
					JOIN giornate ON partite.giornata = giornate.id
					JOIN leghe ON giornate.lega = leghe.id
					JOIN regole AS r ON r.id=leghe.regolamento
					WHERE giornata={$day}";

$result=mysql_query($query_day);
$match=mysql_fetch_assoc($result);
$regolamento=array("gf"=>$match['gol_fatto'],
		"gs"=>$match['gol_subito'],
		"ag"=>$match['autogol'],
		"ass"=>$match['assist'],
		"amm"=>$match['ammonizione'],
		"esp"=>$match['espulsione'],
		"rp"=>$match['rigore_parato'],
		"rs"=>$match['rigore_sbagliato'],
		"gv"=>$match['gol_partita'],
		"gp"=>$match['gol_pareggio']);
//print_r($regolamento);
$giornata=$match['inizio']+$match['numero'];
$content->setContent("LEAGUE_ID", $match['id_lega']);

$voti=checkRate($giornata);
mysql_data_seek($result, 0);


while ($match=mysql_fetch_assoc($result)){
	if(!is_null($match['squadra_casa']) && !is_null($match['squadra_trasferta'])){

		$match_id=$match['id'];
		
		$formation=setFormation($voti, $match_id, $match['squadra_casa'],$giornata,$regolamento); 
		$content->setContent("HOME", $match['nome_casa']);
		$content->setContent("FORMATION_HOME", $formation['template']->get());
		
		$content->setContent("TOTAL_HOME", points2goals(totalFormation($formation['total']))." (".totalFormation($formation['total']).")");
				
		$formation=setFormation($voti, $match_id, $match['squadra_trasferta'],$giornata,$regolamento);
		$content->setContent("AWAY", $match['nome_trasferta']);
		$content->setContent("FORMATION_AWAY", $formation['template']->get());
		
		//print_r($formation['total']);
		$content->setContent("TOTAL_AWAY", points2goals(totalFormation($formation['total']))." (".totalFormation($formation['total']).")");
		//print_r($formation['total']);
		
	}
	else{
		if(is_null($match['squadra_casa']))$riposo=$match['nome_trasferta'];
		else $riposo=$match['nome_casa'];
		$content->setContent("RIPOSO", "<div class=\"alert alert-info\"><strong>Riposa:</strong> ".$riposo."</div>");
	}
}

$footer=new Template($base_path."footer.html");

$base->setContent("LOGIN", $login->get());
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->setContent("FOOTER", $footer->get());
$base->close();

?>