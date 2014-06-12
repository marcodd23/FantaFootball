<?php

function points2goals($points){
	if($points<66)return 0;
	else{
		if(($points-66)%6==0)return ($points-66)/6+1;
		else return round((($points-($points-66)%6)-66)/6+1);
	}
}
function result2classification($gol_home,$gol_away){
	$point=array();
	if($gol_home==$gol_away){
		$point['home']=1;
		$point['away']=1;
	}
	else{
		if($gol_home>$gol_away){
			$point['home']=3;
			$point['away']=0;
		}
		else{
			$point['home']=0;
			$point['away']=3;
		}
	}
	return $point;
}
function updateResult(){
	$result=mysql_query("SELECT * FROM serie_a");
	$serie_a=mysql_fetch_assoc($result);
	$giornata=$serie_a['giornata'];
	$result_leghe=mysql_query("SELECT * FROM leghe");
	while ($lega=mysql_fetch_assoc($result_leghe)){
		//PER OGNI LEGA TROVO LA GIORNATA DI INIZIO PER TROVARE LA GIORNATA VOTI
		$inizio=$lega['inizio'];
		$giornata_lega=$giornata+$lega['inizio'];
		$id_lega=$lega['id'];
		//echo "SELECT * FROM giornate WHERE giornata={$giornata_lega} AND lega={$id_lega}";
		$result=mysql_query("SELECT * FROM giornate WHERE numero={$giornata_lega} AND lega={$id_lega}");
		$giornata_row=mysql_fetch_assoc($result);
		$day=$giornata_row['id'];
		$query_day="SELECT partite. * , giornate.numero, giornate.lega, r1.nome AS nome_casa, r2.nome AS nome_trasferta,
		leghe.nome, leghe.partecipanti, leghe.inizio, r.gol_fatto,r.gol_subito,r.autogol,r.assist,
		r.ammonizione,r.espulsione,r.rigore_parato,r.rigore_sbagliato,r.gol_partita,r.gol_pareggio
		FROM partite
		LEFT JOIN rose AS r1 ON r1.id = partite.squadra_casa
		LEFT JOIN rose AS r2 ON r2.id = partite.squadra_trasferta
		JOIN giornate ON partite.giornata = giornate.id
		JOIN leghe ON giornate.lega = leghe.id
		JOIN regole AS r ON r.id=leghe.regolamento
		WHERE giornata={$day}";
		//echo $query_day;
		$result_day=mysql_query($query_day);
		$match=mysql_fetch_assoc($result_day);
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
		mysql_data_seek($result_day, 0);
		
		
		//PER OGNI GIORNATA CICLO SULLE PARTITE
		while ($match=mysql_fetch_assoc($result_day)){
			if(!is_null($match['squadra_casa']) && !is_null($match['squadra_trasferta'])){
				
				$match_id=$match['id'];
		
				$formation_total_home=resultFormation($match_id, $match['squadra_casa'],$giornata,$regolamento);
				$formation_gol_home=points2goals($formation_total_home);
				
				$formation_total_away=resultFormation($match_id, $match['squadra_trasferta'],$giornata,$regolamento);
				$formation_gol_away=points2goals($formation_total_away);
				
				$query_update_match="UPDATE partite SET punteggio_casa={$formation_total_home},
								punteggio_trasferta={$formation_total_away},
								gol_casa={$formation_gol_home},
								gol_trasferta={$formation_gol_away}
								WHERE id={$match_id}";
				//echo $query_upadate_match;
			//	if(!mysql_query($query_update_match))echo mysql_error();
				
// 				echo "SELECT p.* FROM partecipazioni as p JOIN rose as r ON r.id=p.rosa
// 				 WHERE p.lega={$id_lega} AND p.rosa={$match['squadra_casa']}";

				$rosa=mysql_fetch_assoc(mysql_query("SELECT p.* FROM partecipazioni as p JOIN rose as r ON r.id=p.rosa
				 WHERE p.lega={$id_lega} AND p.rosa={$match['squadra_casa']}"));
				
				$point=result2classification($formation_gol_home, $formation_gol_away);
				$new_punteggio=$rosa['punteggio_totale']+$formation_total_home;
				$new_class=$rosa['punteggio_classifica']+$point['home'];
				$new_gol_f=$rosa['gol_fatti']+$formation_gol_home;
				$new_gol_s=$rosa['gol_subiti']+$formation_gol_away;
				$new_partite=$rosa['partite_giocate']+1;
				
				$query_update_class="UPDATE partecipazioni SET punteggio_totale={$new_punteggio},
										punteggio_classifica={$new_class},
										gol_fatti={$new_gol_f},
										gol_subiti={$new_gol_s},
										partite_giocate={$new_partite}
										WHERE  lega={$id_lega} AND rosa={$match['squadra_casa']} ";

				if(!mysql_query($query_update_class))echo mysql_error();
				
				$rosa=mysql_fetch_assoc(mysql_query("SELECT p.* FROM partecipazioni as p JOIN rose as r ON r.id=p.rosa
						WHERE p.lega={$id_lega} AND p.rosa={$match['squadra_trasferta']}"));
				
				$point=result2classification($formation_gol_home, $formation_gol_away);
				$new_punteggio=$rosa['punteggio_totale']+$formation_total_away;
				$new_class=$rosa['punteggio_classifica']+$point['away'];
				$new_gol_f=$rosa['gol_fatti']+$formation_gol_away;
				$new_gol_s=$rosa['gol_subiti']+$formation_gol_home;
				$new_partite=$rosa['partite_giocate']+1;
				
				$query_update_class="UPDATE partecipazioni SET punteggio_totale={$new_punteggio},
						punteggio_classifica={$new_class},
						gol_fatti={$new_gol_f},
						gol_subiti={$new_gol_s},
						partite_giocate={$new_partite}
						WHERE  lega={$id_lega} AND rosa={$match['squadra_trasferta']} ";
				
				if(!mysql_query($query_update_class))echo mysql_error();
				
				//echo $query_update_class;
				// 				if(!mysql_query($query_update_class))echo mysql_error();
								
			}
		}
	}
	
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

function resultFormation($match_id, $formation_id,$giornata,$regolamento){
	$query="SELECT g. * , f. * , r.nome AS nome_rosa, v . *
	FROM formazioni AS f JOIN (giocatori AS g, rose AS r, voti AS v)
	ON ( f.giocatore = g.id AND r.id = f.rosa AND g.id = v.giocatore )
	WHERE partita ={$match_id} AND rosa ={$formation_id}
	AND v.giornata ={$giornata}
	ORDER BY numero, ruolo";
	//echo "<br>".$query."<br>";
	$result=mysql_query($query);
	while ($player=mysql_fetch_assoc($result)){
		$total_player=total($player, $regolamento);
		$total=array("numero"=>$player['numero'],"ruolo"=>$player['ruolo'],"total"=>$total_player);
		$total_array[]=$total;
	}
	$total_form=0;
	for ($i=0;$i<11;$i++){
		$form=$total_array[$i];
		if($form['total']=="-"){
			switch ($form['ruolo']){
				case 1:
					if($total_array[11]['total']=="-")$total_form+=0;
					else $total_form+=$total_array[11]['total'];
					break;
				case 2:
					if($total_array[12]['total']="-"){
						if($total_array[13]['total']=="-"){
							$total_form+=0;
						}
						else{
							$total_form+=$total_array[13]['total'];
							$total_array[13]['total']="-";
						}
					}
					else{
						$total_form+=$total_array[12]['total'];
						$total_array[12]['total']="-";
	
					}
					break;
				case 3:if($total_array[14]['total']=="-"){
					if($total_array[15]['total']=="-"){
						$total_form+=0;
					}
					else{
						$total_form+=$total_array[15]['total'];
						$total_array[15]['total']="-";
					}
				}
				else{
					$total_form+=$total_array[14]['total'];
					$total_array[14]['total']="-";
				}
				break;
				case 4:if($total_array[16]['total']=="-"){
					if($total_array[17]['total']=="-"){
						$total_form+=0;
					}
					else{
						$total_form+=$total_array[17]['total'];
						$total_array[17]['total']="-";
					}
				}
				else{
					$total_form+=$total_array[16]['total'];
					$total_array[16]['total']="-";
				}
				break;
			}
		}
		else{
			$total_form+=$form['total'];
		}
		//echo $total_form."<br>";
	}
	echo $total_form;
	return $total_form;
}



//updateResult();
//echo points2goals(90);
?>



