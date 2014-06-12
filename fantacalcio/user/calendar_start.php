<?php
include '../include/template2.inc.php';
include '../include/auth.inc.php';
include '../include/util.php';


$league_id=$_GET['id'];
$result=mysql_query("SELECT r.id AS rosa,u.username AS allenatore FROM partecipazioni AS p 
					JOIN (utenti AS u,rose AS r) 
					ON (p.utente=u.id AND r.id=p.rosa) where p.lega={$league_id}");
if(!$result)echo mysql_error();
$arrSquadre=array();
while($partecipazione=mysql_fetch_assoc($result)){
		$arrSquadre[]=$partecipazione['rosa'];
	}

//var_dump($arrSquadre);
//echo "<br>";
$turni=AlgoritmoDiBerger($arrSquadre);
//echo "<br>";
//var_dump($turni);

//echo "ci sono ".count($turni)." giornate ";
$result=mysql_query("SELECT * FROM serie_a");
$serie_a=mysql_fetch_assoc($result);
$giornate_serie_a=$serie_a['giornate'];
$giornata_attuale=$serie_a['giornata'];

$giornate_rimaste=$giornate_serie_a-$giornata_attuale;
// if(count($turni)>$giornate_rimaste)
// 	echo "<br>Non è possibile creare un calendario. Le partite rimaste sono troppo poche<br>";
if($giornate_rimaste%count($turni)==0){
	$gironi=$giornate_rimaste/count($turni);
}
else{
	$gironi=($giornate_rimaste-($giornate_rimaste%count($turni)))/count($turni);
}
//echo "per ".$gironi."gironi <br>";
for($k=0;$k<$gironi;$k++){
	for($i=1;$i<=count($turni);$i++){
		$numero_giornata=$i+(count($turni)*$k);
		//echo "Mi trovo alla giornata ".$i." del girone ".$k."<br>";
		if(!mysql_query("INSERT INTO giornate (numero, lega) VALUES ({$numero_giornata},{$league_id})"))
			//echo "<br>errore giornata ".mysql_error();
		$partite=$turni[$i];
		//echo "il turno ".$i." ha ".count($partite)."partite<br>";
		$id_giornata=mysql_insert_id();
		for($j=0;$j<count($partite);$j++){
			//echo "la ".($j+1)." partita e'<br>";
			$squadra_casa=$partite[$j]['casa'];
			$squadra_trasferta=$partite[$j]['trasferta'];
			//echo $squadra_casa." - ".$squadra_trasferta."<br>";
			//echo $giornata."<br>";
			if($squadra_casa == "BYE"){
				$query="INSERT INTO partite (squadra_trasferta,giornata)
				VALUES ({$squadra_trasferta},{$id_giornata})";
				//echo $query."<br>";
			}
			else{
			if($squadra_trasferta == "BYE"){
			$query="INSERT INTO partite (squadra_casa,giornata)
			VALUES ({$squadra_casa},{$id_giornata})";
			//echo $query."<br>";
			}
			else{
			$query="INSERT INTO partite (squadra_casa,squadra_trasferta,giornata)
			VALUES ({$squadra_casa},{$squadra_trasferta},{$id_giornata})";
			//echo $query."<br>";
			}
			}
	
                        mysql_query($query);
			//if(!mysql_query($query))
			//echo "<br>errore partita".mysql_error();
		}
	}
}

header("Location:calendar.php?league=".$league_id);

?>