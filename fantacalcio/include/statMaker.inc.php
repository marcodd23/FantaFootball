<?php
function updateStat($rate,$player){
//  	$query="SELECT * FROM giornate";
//  	$result=mysql_query($query);
// 	while($giornata=mysql_fetch_assoc($result)){
// 		$query_player="SELECT * FROM voti WHERE giornata="
// 	}
	$result=mysql_query("SELECT * FROM statistiche WHERE giocatore={$player}");
	$statistica=mysql_fetch_assoc($result);
	if($rate!=0){
		$presenze=$statistica['presenze']+1;
		$media=($statistica['media']*$statistica['presenze']+$rate)/$presenze;
		$gol_fatti=$statistica['gol_fatti']+1;
		$gol_subiti=$statistica['gol_subiti']+1;
		$assist=$statistica['assist']+1;
		$ammonizioni=$statistica['ammonizioni']+1;
		$espulsioni=$statistica['espulsioni']+1;
		if(!mysql_query("UPDATE statistiche SET presenze = {$presenze}, 
					gol_fatti ={$gol_fatti},
					gol_subiti ={$gol_subiti},
					tot_assist ={$assist},
					ammonizioni ={$ammonizioni},
					espulsioni ={$espulsioni},
					media ={$media} WHERE giocatore={$player}"))
		echo mysql_error();
	}
}


?>