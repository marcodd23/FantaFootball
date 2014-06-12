<?php
function points2goals($points){
	if($points<66)return 0;
	else{
		if(($points-66)%6==0)return ($points-66)/6+1;
		else return round((($points-($points-66)%6)-66)/6+1);
	}
}

function checkRate($giornata){
	if(!mysql_num_rows(mysql_query("SELECT * FROM voti WHERE giornata={$giornata}"))) return false;
	else return true;
	
}
function total($player,$regolamento){
	if($player['voto']==0)return "-";
	else
	return $player['voto']+
		   $player['gol_fatto']*$regolamento['gf']+
		   $player['gol_subito']*$regolamento['gs']+
		   $player['autogol']*$regolamento['ag']+
		   $player['assist']*$regolamento['ass']+
		   $player['ammonizione']*$regolamento['amm']+
		   $player['espulsione']*$regolamento['esp']+
		   $player['rigore_parato']*$regolamento['rp']+
		   $player['rigore_sbagliato']*$regolamento['rs']+
		   $player['gol_partita']*$regolamento['gv']+
		   $player['gol_pareggio']*$regolamento['gp'];
}
function totalFormation($formation){
	$total_form=0;
	for ($i=0;$i<11;$i++){
		//echo $i."<br>";
		//echo count($formation['total'])."<br>";
		$form=$formation[$i];
		//echo count($form)."<br>";
		//print_r($form)."<br>";
		if($form['total']=="-"){
			switch ($form['ruolo']){
				case 1:
					if($formation[11]['total']=="-")$total_form+=0;
					else $total_form+=$formation[11]['total'];
					break;
				case 2:
					if($formation[12]['total']="-"){
						if($formation[13]['total']=="-"){
							$total_form+=0;
						}
						else{
							$total_form+=$formation[13]['total'];
							$formation[13]['total']="-";
						}
					}
					else{
						$total_form+=$formation[12]['total'];
						$formation[12]['total']="-";
						
					}
					break;
				case 3:if($formation[14]['total']=="-"){
					if($formation[15]['total']=="-"){
						$total_form+=0;
					}
					else{
						$total_form+=$formation[15]['total'];
						$formation[15]['total']="-";
					}
				}
				else{
					$total_form+=$formation[14]['total'];
					$formation[14]['total']="-";
				}
				break;
				case 4:if($formation[16]['total']=="-"){
					if($formation[17]['total']=="-"){
						$total_form+=0;
					}
					else{
						$total_form+=$formation[17]['total'];
						$formation[17]['total']="-";
					}
				}
				else{
					$total_form+=$formation[16]['total'];
					$formation[16]['total']="-";
				}
				break;
			}
		}
		else{
			$total_form+=$form['total'];
		}
		//echo $total_form."<br>";
	}
	return $total_form;
}
function setFormation($voti,$match_id,$formation_id,$giornata,$regolamento){
	$total_array=array();
	$base_path="../dtml/user/";
	if($voti) $query="SELECT g. * , f. * , r.nome AS nome_rosa, v . *
							FROM formazioni AS f JOIN (giocatori AS g, rose AS r, voti AS v)
							ON ( f.giocatore = g.id AND r.id = f.rosa AND g.id = v.giocatore )
							WHERE partita ={$match_id} AND rosa ={$formation_id}
							AND v.giornata ={$giornata}
							ORDER BY numero, ruolo";
	else $query="SELECT  g . * , f . * , r.nome AS nome_rosa
							FROM formazioni AS f JOIN (giocatori AS g, rose as r)
							ON (f.giocatore = g.id AND r.id=f.rosa)
							WHERE partita={$match_id} AND rosa={$formation_id}
							ORDER BY numero,ruolo";
	//echo $query;
	$result1=mysql_query($query);
	$formation_day=new Template($base_path."formation_day.html");
	if(mysql_num_rows($result1)==0){
		for($i=0;$i<18;$i++){
			$formation_day->setContent("NOME","-");
			$formation_day->setContent("VOTO", "-");
			$formation_day->setContent("BONUS", "-");
			$formation_day->setContent("TOTALE", "-");
			if($i==10)$formation_day->setContent("RISERVE",
					"<tr><th class=\"left\"  style=\"background-color: #f9f9f9;\"
					colspan=\"4\">RISERVE</th></tr>");
			else $formation_day->setContent("RISERVE", "");
		}
	}
	else{
		while ($player=mysql_fetch_assoc($result1)){
			$bonus="";
			$sost=array("status","counter","role");
			$formation_day->setContent("NOME", $player['cognome']." ".substr($player['nome'],0,1).".");
			switch ($player['ruolo']){
				case 1:$ruolo_class="portiere_leggend";
				break;
				case 2:$ruolo_class="difensore_leggend";
				break;
				case 3:$ruolo_class="centrocampista_leggend";
				break;
				case 4:$ruolo_class="attaccante_leggend";
				break;
			}
			$formation_day->setContent("CLASS", $ruolo_class);
			//echo $player['voto']."<br>";
			//echo "<pre>".print_r($player)."</pre>";
			//if($player['voto']!=0)echo "true";else echo "false";
			if($player['voto']!=0)
			$formation_day->setContent("VOTO", $player['voto']);
			else{
				$formation_day->setContent("VOTO", "-");
				if($player['numero']<12);
				//$bonus.="<img src=\"../resources/my/images/icon/out.png\" title=\"Sostituzione\" alt=\"Sost\"/>";
				
			} 
				
				
// 			echo "<br>Giocatore: ".$player['cognome']."<br>";
// 			echo "<br>Gol fatto: ".$player['gol_fatto']."<br>";
// 			echo "<br>Gol subito: ".$player['gol_subito']."<br>";
// 			echo "<br>Autogol: ".$player['autogol']."<br>";
// 			echo "<br>Assist: ".$player['assist']."<br>";
// 			echo "<br>Ammonizione: ".$player['ammonizione']."<br>";
// 			echo "<br>Espulsione: ".$player['espulsione']."<br>";
// 			echo "<br>Rigore parato: ".$player['rigore_parato']."<br>";
// 			echo "<br>Rigore sbagliato: ".$player['rigore_sbagliato']."<br>";
// 			echo "<br>Gol partita: ".$player['gol_partita']."<br>";
// 			echo "<br>Gol pareggio: ".$player['gol_pareggio']."<br>";
				
			if($player['gol_fatto']) $bonus.="<img src=\"../resources/my/images/icon/gf.png\" alt=\"gf\" title=\"Gol fatti\"/> (".$player['gol_fatto'].") ";
			//else echo "false ";
			if($player['gol_subito']) $bonus.="<img src=\"../resources/my/images/icon/gs.png\" alt=\"gs\" title=\"Gol subiti\"/> (".$player['gol_subito'].") ";
			//else echo "false ";
			if($player['autogol']) $bonus.="<img src=\"../resources/my/images/icon/ag.png\" alt=\"ag\" title=\"Autogol\"/> (".$player['autogol'].") ";
			// else echo "false ";
			if($player['assist']) $bonus.="<img src=\"../resources/my/images/icon/ass.png\" alt=\"ass\" title=\"Assist\"/> (x".$player['assist'].") ";
			// else echo "false ";
			if($player['ammonizione']) $bonus.="<img src=\"../resources/my/images/icon/amm.png\" alt=\"amm\" title=\"Ammonizione\"/>";
			// else echo "false ";
			if($player['espulsione']) $bonus.="<img src=\"../resources/my/images/icon/esp.png\" alt=\"esp\" title=\"Espulsione\"/>";
			// else echo "false ";
			if($player['rigore_parato']) $bonus.="<img src=\"../resources/my/images/icon/rp.png\" alt=\"rp\" title=\"Rigore parati\"/> (".$player['rigore_parato'].") ";
			// else echo "false ";
			if($player['rigore_sbagliato']) $bonus.="<img src=\"../resources/my/images/icon/rs.png\" alt=\"rs\" title=\"Rigore sbagliati\"/> (".$player['rigore_sbagliato'].") ";
			// else echo "false ";
			if($regolamento['gol_partita']!=0){
				if($player['gol_partita']) $bonus.="<img src=\"../resources/my/images/icon/gv.png\" alt=\"gv\" title=\"Gol partita\"/>";
				// else echo "false ";
			}
			if($regolamento['gol_pareggio']!=0){
				if($player['gol_pareggio']) $bonus.="<img src=\"../resources/my/images/icon/gp.png\" alt=\"gp\" title=\"Gol pareggio\"/>";
				// else echo "false ";
			}
			if($bonus=="")$bonus.="-";
			//echo $bonus;
			//else $bonus=$gf.$gs.$ag.$ass.$amm.$esp.$rp.$rs.$gv.$gp;
			$formation_day->setContent("BONUS", $bonus);
			$total_player=total($player, $regolamento);
			$formation_day->setContent("TOTALE",$total_player );
			$total=array("numero"=>$player['numero'],"ruolo"=>$player['ruolo'],"total"=>$total_player);
			$total_array[]=$total;
			if($player['numero']==11)$formation_day->setContent("RISERVE", 
						"<tr><th class=\"left\"  style=\"background-color: #f9f9f9;\"
					colspan=\"4\">RISERVE</th></tr>");
			else $formation_day->setContent("RISERVE", "");
		}
	}
	return $formation=array("template"=>$formation_day,"total"=>$total_array);
}
