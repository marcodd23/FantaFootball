<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';

$id_league=$_GET['league'];

//checkAuthorization("user/league_start.php");

$base_path="../dtml/user/";
$base=new Template($base_path."base.html");
$login=new Template($base_path."login.html");
$login->setContent("USERNAME", $_SESSION['user']);
$menu=new Template($base_path."menu.html");
$content=new Template($base_path."calendar_views.html");
$content->setContent("LEAGUE_ID", $id_league);

$result=mysql_query("SELECT MAX(numero) AS giornate FROM giornate WHERE lega={$id_league}");
$max=mysql_fetch_assoc($result);
$giornate= $max['giornate'];
echo $giornate;

for($i=1;$i<=$giornate;$i++){
	//echo "<br>Giornata ".$i;
	$content->setContent("GIORNATA", $i);
	$calendar_day=new Template($base_path."calendar_day.html");
	$result=mysql_query("SELECT l.nome AS lega,l.partecipanti,  g.id AS id_giornata,g.numero AS numero_giornata, p.squadra_casa AS id_casa, 
				r1.nome AS squadra_casa, p.squadra_trasferta AS id_trasferta, r2.nome AS squadra_trasferta,
				p.punteggio_casa,p.gol_casa,p.punteggio_trasferta,p.gol_trasferta
				FROM partite AS p
				JOIN (giornate AS g, leghe AS l) ON ( p.giornata = g.id AND g.lega = l.id )
				LEFT JOIN rose AS r1 ON p.squadra_casa = r1.id
				LEFT JOIN rose AS r2 ON p.squadra_trasferta = r2.id
			WHERE l.id={$id_league} AND g.numero={$i}");
	$scontro="";
	$riposo=array("exist"=>false,"squadra"=>"");
	while ($partita=mysql_fetch_assoc($result)){
		if($partita['squadra_casa']==null)
			$riposo=array("exist"=>true,"squadra"=>$partita['squadra_trasferta']);
			//$riposo= "<br>Riposo: ".$partita['squadra_trasferta'];
		else{
			if($partita['squadra_trasferta']==null)
				$riposo=array("exist"=>true,"squadra"=>$partita['squadra_casa']);
				//$riposo= "<br>Riposo: ".$partita['squadra_casa'];
			else{
				$calendar_day->setContent("CASA", $partita['squadra_casa']);
				if(!is_null($partita['punteggio_casa']))
					$calendar_day->setContent("PUNTEGGIO_HOME", "(".$partita['punteggio_casa'].")");
						
				$calendar_day->setContent("TRASFERTA", $partita['squadra_trasferta']);
				if(!is_null($partita['punteggio_trasferta']))
					$calendar_day->setContent("PUNTEGGIO_AWAY", "(".$partita['punteggio_trasferta'].")");
					
				$calendar_day->setContent("RISULTATO", $partita['gol_casa']." - ".$partita['gol_trasferta']);
				$calendar_day->setContent("DAY", $partita['id_giornata']);
				//$scontro= "<br>".$partita['squadra_casa']." - ".$partita['squadra_trasferta'];
				//echo $scontro;
			}
		}
	}
	if($riposo['exist'])
		$calendar_day->setContent("RIPOSO","<tr><td colspan=\"4\">Riposo: ".$riposo['squadra']."</td></tr>");
	$content->setContent("RESULT", $calendar_day->get());
}
$footer=new Template($base_path."footer.html");

$base->setContent("LOGIN", $login->get());
$base->setContent("MENU", $menu->get());
$base->setContent("CONTENT", $content->get());
$base->setContent("FOOTER", $footer->get());
$base->close();

 
?>