<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';

checkAuthorization("user/league.php");
//echo "porco dio"
$username=$_SESSION['user'];
if(isset($_GET['id'])){
	$id_league=$_GET['id'];
	$result=mysql_query("SELECT * FROM leghe JOIN regole ON (leghe.regolamento=regole.id) WHERE leghe.id={$id_league}");
	if(mysql_num_rows($result)==0){
		header("Location:../error.php?code=500");
		exit();
	}
	checkIfIsLeaguePartecipant($id_league);
	$base_path="../dtml/user/";
	$base=new Template($base_path."base.html");	
	$login=new Template($base_path."login.html");
	$login->setContent("USERNAME", $_SESSION['user']);
	$menu=new Template($base_path."menu.html");
	$content= new Template($base_path."league_views.html");
	$content->setContent("LEAGUE_ID", $id_league);
	
	$lega=mysql_fetch_assoc($result);
	
	$content->setContent("LEAGUE_NAME", $lega['nome']);
	
	$item_active=new Template($base_path."team_item_active.html");
	$item_invited=new Template($base_path."team_item_invited.html");
	$item_toInvite=new Template($base_path."team_item_toInvite.html");
	
	/**
	 * IMPLEMENTAZIONE SEZIONE 1 (PARTECIPANTI LEGA)
	 * 
	 */	
	$result=mysql_query("SELECT * FROM partecipazioni AS p JOIN utenti AS u ON (p.utente=u.id)
						WHERE lega={$id_league}");
	$partecipanti_aggiunti=mysql_numrows($result);
	//echo $partecipanti_aggiunti;
	$i=1;
	while($partecipazione=mysql_fetch_assoc($result)){
		//echo "analizzo ". $partecipazione['username']."<br>";
		if($partecipazione['rosa']==null){
			//echo "rosa nulla<br>";
			$item_active->setContent("TEAM", "Squadra ".$i);
			if($username==$partecipazione['username']||
					isLeagueAdmin($id_league, $username)){
				$item_active->setContent("ROSA_TITLE", "Crea rosa");
				$user=$partecipazione['id'];
				$_REQUEST['league']=$id_league;
				$_REQUEST['user']=$user;
				$item_active->setContent("ROSA_HREF","team_start.php?action=create&league=".$id_league."&user=".$user); //"javascript:creaTeam(".$user.");");
				$item_active->setContent("ROSA_ICON", "icon-magic");
				$item_active->setContent("CLASS", "");
			}
			else{
				$item_active->setContent("ROSA_TITLE", "Rosa non creata");
				$item_active->setContent("ROSA_HREF", "javascript:event.preventDefault();");
				$item_active->setContent("ROSA_ICON", "icon-info-circle");
				$item_active->setContent("CLASS", "default_cursor");
			}
		}
		else{
			//echo "rosa piena<br>";
			$id_rosa=$partecipazione['rosa'];
			$rose_result=mysql_query("SELECT * FROM rose WHERE id={$id_rosa}");
			$rosa=mysql_fetch_assoc($rose_result);
			$item_active->setContent("TEAM", $rosa['nome']);
			$item_active->setContent("ROSA_TITLE", "Vedi rosa");
			$item_active->setContent("ROSA_HREF", "team.php?id=".$partecipazione['rosa']);
			$item_active->setContent("ROSA_ICON", "icon-list-numbered");
			$item_active->setContent("CLASS", "");
		}
		$item_active->setContent("USERNAME", $partecipazione['username']);
		if(isLeagueAdmin($id_league, $username)){
			$option_admin=new Template($base_path."team_option_admin.html");
			$item_active->setContent("OPTION_ADMIN", $option_admin->get());
		}
		$i++;
	}
	//TROVO E SETTO GLI UTENTI INVITATI
	$result=mysql_query("SELECT i.id AS id, utente_invitato.username AS invitato_username, utente_invitante.username AS invitante_username
			 				FROM inviti AS i JOIN (utenti AS utente_invitante, utenti AS utente_invitato )
			 				ON (i.invitato=utente_invitato.id AND i.invitante=utente_invitante.id)
							WHERE i.lega={$id_league}");
	$inviti=mysql_num_rows($result);
	//echo $inviti."<br>";
	$i=$partecipanti_aggiunti;
	while ($invito=mysql_fetch_assoc($result)){
		$item_invited->setContent("ID_INVITO", $invito['id']);
		$item_invited->setContent("USERNAME", $invito['invitato_username']);
		$item_invited->setContent("TEAM_NUMBER", $i+1);
		if(isLeagueAdmin($id_league, $username)){
			$item_invited->setContent("HREF", "removeInvite.php?id=".$invito['id']);
			$item_invited->setContent("TITLE", "Rimuovi invito");
			$item_invited->setContent("ICON", "icon-ccw");
			$item_invited->setContent("CLASS", "");
		}
		else{
			$item_invited->setContent("HREF", "javascript:event.preventDefault();");
			$item_invited->setContent("TITLE", "In attesa di risposta");
			$item_invited->setContent("ICON", "icon-clock");
			$item_invited->setContent("CLASS", "default_cursor");
		}
		$i++;
	}
	//TROVO E SETTO GLI UTENTI NON INVITATI E CHE MANCANO
	$not_invited=$lega['partecipanti']-$partecipanti_aggiunti-$inviti;
	//echo $not_invited."<br>";
	$team_number=$partecipanti_aggiunti+$inviti+1;
	for($i=0;$i<$not_invited;$i++){
		if(isLeagueAdmin($id_league, $username)){
			$item_toInvite->setContent("TITLE", "Invita allenatore");
			$item_toInvite->setContent("HREF", "javascript:openDialog('".$team_number."')");
			$item_toInvite->setContent("ICON", "icon-plus-circle");
			$item_toInvite->setContent("CLASS", "");
		}
		else{
			$item_toInvite->setContent("TITLE", "Utente non invitato");
			$item_toInvite->setContent("HREF", "javascript:event.preventDefault();");
			$item_toInvite->setContent("ICON", "icon-info-circle");
			$item_toInvite->setContent("CLASS", "default_cursor");
		}
		$item_toInvite->setContent("TEAM_NUMBER", $team_number);
		$item_toInvite->setContent("USER_NUMBER", $team_number);
		$team_number+=1;
	}
	$result=mysql_query("SELECT * FROM partecipazioni AS p JOIN utenti AS u ON (p.utente=u.id) 
			WHERE lega={$id_league}");
		
	/** TROVO LE MAIL DEGLI UNTENTI CHE POSSO INVITARE**/
	if($not_invited!=0){
	$where="";
		while($partecipazione=mysql_fetch_assoc($result)){
			$where.=" AND id!={$partecipazione['utente']}";
		}
		$result=mysql_query("SELECT * FROM utenti WHERE gruppo!=1 ".$where);
		$emails="";
		while($utente=mysql_fetch_assoc($result)){
			$email=$utente['email'];
			$emails.="\"".$email."\",";
		}
		$emails=substr($emails, 0,strlen($emails)-1);
		$item_toInvite->setContent("EMAILS", $emails);
		$item_toInvite->setContent("LEAGUE_ID", $id_league);
	}
	$content->setContent("ITEM_ACTIVE", $item_active->get());
	$content->setContent("ITEM_TOINVITE", $item_toInvite->get());
	$content->setContent("ITEM_INVITED", $item_invited->get());
	
	/**
	 * IMPLEMENTAZIONE SEZIONE 2 (CLASSIFICA)
	 *
	 */
	
	$section2=new Template($base_path."classification.html");
	$result=mysql_query("SELECT * FROM partecipazioni AS p JOIN rose AS r
			ON p.rosa=r.id
			WHERE lega={$id_league} ORDER BY  p.punteggio_classifica DESC,p.punteggio_totale DESC ");
	while ($rosa=mysql_fetch_assoc($result)){
		$section2->setContent("ROSA", $rosa['nome']);
		$section2->setContent("GIORNATE", $rosa['nome']);
		$section2->setContent("GF", $rosa['gol_fatti']);
		$section2->setContent("GS", $rosa['gol_subiti']);
		$section2->setContent("DIFF", $rosa['gol_fatti']-$rosa['gol_subiti']);
		$section2->setContent("PT", $rosa['punteggio_totale']);
		$section2->setContent("PC", $rosa['punteggio_classifica']);
	}
	$content->setContent("CLASSIFICATION", $section2->get());
	
	
	/**
	 * IMPLEMENTAZIONE SEZIONE 3 (CALENDARIO)
	 *
	 */
	$result=mysql_query("SELECT * FROM  giornate WHERE lega={$id_league}");
	$num_rounds=mysql_num_rows($result);
	if($num_rounds==0){
		$section3=new Template($base_path."calendar_false.html");
		$section3->setContent("LEAGUE_ID", $id_league);
		$content->setContent("CALENDAR", $section3->get());
	}
	else{
		$section3=new Template($base_path."calendar_true.html");
		$section3->setContent("LEAGUE_ID", $id_league);
		$result=mysql_query("SELECT * FROM serie_a");
		$serie_a=mysql_fetch_assoc($result);
		$giornata_attuale_serie_a=$serie_a['giornata'];
		$giornate_serie_a=$serie_a['giornate'];
		//echo "Giornata attuale serie A: ".$giornata_attuale_serie_a."<br>";
		//$giornata_scorsa_serie_a=$serie_a['giornata']-1;
		//$giornata_prossima_serie_a=$serie_a['giornata']+1;
		$result=mysql_query("SELECT * FROM leghe WHERE id={$id_league}");
		$lega=mysql_fetch_assoc($result);
		$inizio_lega=$lega['inizio'];
		//echo "Lega iniziata la ".$inizio_lega." a giornata<br>";
		$giornata_attuale_lega=$giornata_attuale_serie_a-$inizio_lega+1;
		//echo "Siamo alla ".$giornata_attuale_lega."a giornata di lega<br>";
		
		$result=mysql_query("SELECT max(numero) as giornate FROM giornate WHERE lega={$id_league}");
		$max=mysql_fetch_assoc($result);
		$giornate=$max['giornate'];
		
		/////////////////////////////////////////////////////////////////
		/////  TROVO E SETTO LE PARTITE DELL'ULTIMA GIORNATA   /////////
		////////////////////////////////////////////////////////////////
		
		if($giornata_attuale_lega==1) $giornata_scorsa_lega=$giornata_attuale_lega;
		else $giornata_scorsa_lega=$giornata_attuale_lega-1;
		
		$calendar_day=new Template($base_path."calendar_day.html");
		$result=mysql_query("SELECT l.nome AS lega,l.partecipanti,  g.id AS id_giornata,g.numero AS numero_giornata, p.squadra_casa AS id_casa, 
				r1.nome AS squadra_casa, p.squadra_trasferta AS id_trasferta, r2.nome AS squadra_trasferta,
				p.punteggio_casa,p.gol_casa,p.punteggio_trasferta,p.gol_trasferta
				FROM partite AS p
				JOIN (giornate AS g, leghe AS l) ON ( p.giornata = g.id AND g.lega = l.id )
				LEFT JOIN rose AS r1 ON p.squadra_casa = r1.id
				LEFT JOIN rose AS r2 ON p.squadra_trasferta = r2.id
				WHERE l.id={$id_league} AND g.numero={$giornata_scorsa_lega}");
// 	echo "SELECT l.nome AS lega,l.partecipanti, g.numero AS numero_giornata, p.squadra_casa AS id_casa, 
// 				r1.nome AS squadra_casa, p.squadra_trasferta AS id_trasferta, r2.nome AS squadra_trasferta,
// 				p.punteggio_casa,p.gol_casa,p.punteggio_trasferta,p.gol_trasferta
// 				FROM partite AS p
// 				JOIN (giornate AS g, leghe AS l) ON ( p.giornata = g.id AND g.lega = l.id )
// 				LEFT JOIN rose AS r1 ON p.squadra_casa = r1.id
// 				LEFT JOIN rose AS r2 ON p.squadra_trasferta = r2.id
// 				WHERE l.id={$id_league} AND g.numero={$giornata_scorsa_lega}";
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
					$calendar_day->setContent("PUNTEGGIO_HOME", "(".$partita['punteggio_casa'].")");
						
					$calendar_day->setContent("TRASFERTA", $partita['squadra_trasferta']);
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
		
		$section3->setContent("GIORNATA_LAST","(".$giornata_scorsa_lega."a)");
		$section3->setContent("LAST", $calendar_day->get());
		
		/////////////////////////////////////////////////////////////////
		/////  TROVO E SETTO LE PARTITE DELLA GIORNATA ATTUALE   ///////
		////////////////////////////////////////////////////////////////
		
		$calendar_day=new Template($base_path."calendar_day.html");
		$result=mysql_query("SELECT l.nome AS lega, l.partecipanti, g.numero AS numero_giornata,
							p.id as id_partita,p.squadra_casa AS id_casa, r1.nome AS squadra_casa, 
							p.squadra_trasferta AS id_trasferta, r2.nome AS squadra_trasferta,
							u1.username AS username_casa, u2.username AS username_trasferta
							FROM partite AS p JOIN (giornate AS g, leghe AS l) 
							ON ( p.giornata = g.id AND g.lega = l.id ) 
							LEFT JOIN rose AS r1 ON p.squadra_casa = r1.id
							LEFT JOIN rose AS r2 ON p.squadra_trasferta = r2.id
							LEFT JOIN (partecipazioni AS part1, utenti AS u1) 
							ON ( part1.rosa = r1.id AND part1.utente = u1.id ) 
							LEFT JOIN (partecipazioni AS part2, utenti AS u2) 
							ON ( part2.rosa = r2.id AND part2.utente = u2.id ) 
							WHERE l.id={$id_league} AND g.numero={$giornata_attuale_lega}");
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
					if($username==$partita['username_casa']) 
						$calendar_day->setContent("CASA", $partita['squadra_casa'].
								" <a href=\"formation_start.php?action=create&id=".$partita['id_partita'].
								"&rosa=".$partita['id_casa']."\" title=\"Inserisci formazione\"><i class=\"icon-list-bullet\"></i></a>");
					else $calendar_day->setContent("CASA", $partita['squadra_casa']);
						
					if($username==$partita['username_trasferta'])
						$calendar_day->setContent("TRASFERTA", $partita['squadra_trasferta'].
								" <a href=\"formation_start.php?action=create&id=".$partita['id_partita'].
								"&rosa=".$partita['id_trasferta']."\" title=\"Inserisci formazione\"><i class=\"icon-list-bullet\"></i></a>");
					else $calendar_day->setContent("TRASFERTA", $partita['squadra_trasferta']);
					$calendar_day->setContent("RISULTATO", "-");
					//$scontro= "<br>".$partita['squadra_casa']." - ".$partita['squadra_trasferta'];
					//echo $scontro;
				}
			}
		}
		if($riposo['exist'])
			$calendar_day->setContent("RIPOSO","<tr><td colspan=\"4\">Riposo: ".$riposo['squadra']."</td></tr>");
		
		if($giornata_attuale_lega<=$giornate){
			$section3->setContent("GIORNATA_NOW","(".$giornata_attuale_lega."a)");
			$section3->setContent("NOW", $calendar_day->get());
		}
		
		/////////////////////////////////////////////////////////////////
		/////  TROVO E SETTO LE PARTITE DELLA PROSSIMA PARTITA   ///////
		////////////////////////////////////////////////////////////////
		
		if($giornata_attuale_lega+1>$giornate || $inizio_lega+$giornata_attuale_serie_a>=$giornate_serie_a)
			$giornata_prossima_lega=$giornata_attuale_lega;
		else $giornata_prossima_lega=$giornata_attuale_lega+1;
		
		$calendar_day=new Template($base_path."calendar_day.html");
		$result=mysql_query("SELECT l.nome AS lega,l.partecipanti, g.numero AS numero_giornata, p.squadra_casa AS id_casa, r1.nome AS squadra_casa, p.squadra_trasferta AS id_trasferta, r2.nome AS squadra_trasferta
				FROM partite AS p
				JOIN (giornate AS g, leghe AS l) ON ( p.giornata = g.id AND g.lega = l.id )
				LEFT JOIN rose AS r1 ON p.squadra_casa = r1.id
				LEFT JOIN rose AS r2 ON p.squadra_trasferta = r2.id
				WHERE l.id={$id_league} AND g.numero={$giornata_prossima_lega}");
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
					$calendar_day->setContent("TRASFERTA", $partita['squadra_trasferta']);
					$calendar_day->setContent("RISULTATO", "risultato");
					//$scontro= "<br>".$partita['squadra_casa']." - ".$partita['squadra_trasferta'];
					//echo $scontro;
				}
			}
		}
		if($riposo['exist'])
			$calendar_day->setContent("RIPOSO","<tr><td colspan=\"4\">Riposo: ".$riposo['squadra']."</td></tr>");
		if($giornata_prossima_lega<=$giornate){
			$section3->setContent("GIORNATA_NEXT","(".$giornata_prossima_lega."a)");
			$section3->setContent("NEXT", $calendar_day->get());
		}
		$content->setContent("CALENDAR", $section3->get());
	}
	
	$footer=new Template($base_path."footer.html");
	
	$base->setContent("LOGIN", $login->get());
	$base->setContent("MENU", $menu->get());
	$base->setContent("CONTENT", $content->get());
	$base->setContent("FOOTER", $footer->get());
	$base->close();
}
else{
	header("Location:../error.php?code=500");
}

?>