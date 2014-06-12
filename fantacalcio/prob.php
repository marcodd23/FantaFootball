<?php

include './include/template2.inc.php';
include './include/auth.inc.php';
	
	//checkAuthorization("subscription_start.php");

		$base_path="./dtml/";
		$base=new Template($base_path."base.html");
		if(isLogged()){
			$username=$_SESSION['user'];
			$base_path_user="./dtml/user/";
			$login=new Template($base_path_user."login.html");
			$login->setContent("USERNAME", $username);
		}
		else $login=new Template($base_path."login.html");
		$menu=new Template($base_path."menu.html");
		$content=new Template($base_path."prob.html");
		
		$result=mysql_query("SELECT p.id as id, s1.id as squadra_casa_id, s1.nome as squadra_casa, 
							s2.id as squadra_trasferta_id, s2.nome as squadra_trasferta
							FROM   partite_serie_a AS p JOIN (squadre AS s1, squadre AS s2) 
							ON ( squadra_casa = s1.id AND squadra_trasferta = s2.id)");
		while($partita=mysql_fetch_assoc($result)){
			$content->setContent("PARTITA", $partita['squadra_casa']." - ".$partita['squadra_trasferta']);
			$result_casa=mysql_query("SELECT * FROM probabili_formazioni as p JOIN giocatori as g 
								ON (g.id=p.giocatore) WHERE p.squadra={$partita['squadra_casa_id']}");
			$prob_casa=new Template($base_path."prob_form_table.html");
			while($giocatori=mysql_fetch_assoc($result_casa)){
				$prob_casa->setContent("NOME", $giocatori['cognome']." ".$giocatori['nome']);
				switch ($giocatori['ruolo']){
					case 1:$class="portiere_leggend";break;
					case 2:$class="difensore_leggend";break;
					case 3:$class="centrocampista_leggend";break;
					case 4:$class="attaccante_leggend";break;
						
				}
				$prob_casa->setContent("CLASS", $class);
			}
			$content->setContent("PROB_CASA", $prob_casa->get());
			
			$result_casa=mysql_query("SELECT * FROM probabili_formazioni as p JOIN giocatori as g
					ON (g.id=p.giocatore) WHERE p.squadra={$partita['squadra_trasferta_id']}");
			$prob_trasf=new Template($base_path."prob_form_table.html");
			while($giocatori=mysql_fetch_assoc($result_casa)){
				$prob_trasf->setContent("NOME", $giocatori['cognome']." ".$giocatori['nome']);
				switch ($giocatori['ruolo']){
					case 1:$class="portiere_leggend";break;
					case 2:$class="difensore_leggend";break;
					case 3:$class="centrocampista_leggend";break;
					case 4:$class="attaccante_leggend";break;
			
				}
				$prob_trasf->setContent("CLASS", $class);
			}
			$content->setContent("PROB_TRASF", $prob_trasf->get());
		}
		
		$footer=new Template($base_path."footer.html");
	
		$base->setContent("LOGIN", $login->get());
		$base->setContent("MENU", $menu->get());
		$base->setContent("CONTENT", $content->get());
		$base->setContent("FOOTER", $footer->get());
		$base->close();

?>