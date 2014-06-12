<?php
include '../include/auth.inc.php';

$league_id=$_POST['id'];

$result=mysql_query("SELECT * FROM leghe WHERE id={$league_id}");
$error=mysql_error();
$lega=mysql_fetch_assoc($result);
$num_players=$lega['partecipanti'];

$result=mysql_query("SELECT * FROM partecipazioni WHERE lega={$league_id}");
$error.=mysql_error();

$not_team=0;
$invite_accepted=mysql_num_rows($result); //numero di partecipanti che hanno accettato l'invito
$status=true;
if($num_players==$invite_accepted){//se tutti hanno accettato l'invito controllo che tutti abbiano una rosa
	while($partecipazione=mysql_fetch_assoc($result)){
		if($partecipazione['rosa']==null){
			$status=false;
			$not_team+=1;	
		}
	}
}
else{
	$status=false;
}


$not_invite_accepted=$num_players-$invite_accepted;

$json_result=array("status"=>$status,
		"message"=>"Per creare un calendario tutti i partecipanti devono accettare l'invito e creare una rosa",
		"error"=>$error,
		"players"=>$num_players,
		"invite_accepted"=>$invite_accepted,
		"not_invited"=>$not_invite_accepted,
		"not_team"=>$not_team);
header('Content-Type: application/json');
echo json_encode($json_result);
?>