<?php 

require '../include/mailer.inc.php';
include '../include/auth.inc.php';

	checkAuthorization("user/sendInvite.php");
	checkIfIsLeagueAdmin($_POST['league_id']);
	
	$email=$_POST['email'];
	$username=$_SESSION['user'];
	$id=$_POST['league_id'];
	
	$result=mysql_query("SELECT * FROM utenti WHERE username='{$username}'");
	$utenti=mysql_fetch_assoc($result);
	$invitante=$utenti['id'];
	
	$result=mysql_query("SELECT * FROM utenti WHERE email='{$email}'");
	$utenti=mysql_fetch_assoc($result);
	$invitato=$utenti['id'];
	$username_invitato=$utenti['username'];
	
	
	
	$result=mysql_query("SELECT * FROM leghe WHERE id={$id}");
	$leghe=mysql_fetch_assoc($result);
	$lega=$leghe['nome'];
	
	$code=hash('ripemd160', $invitante.$invitato.$id);
	
	$message="Sei stato invitato da ".$username." alla lega ".$lega."\n
	Per accettare l'invito accedi a Fantaweb con il tuo account e copia questo link sulla barra degli indirizzi\n
	http://localhost/fantacalcio/user/acceptInvite.php?id=".$code;
	
	$result=inviamail($_POST['email'], "Invito lega fantaweb", $message);//richiamiamo la funzione
	
	if(!$result['error'])
	mysql_query("INSERT INTO inviti (invitante, invitato, lega, codice) VALUES ({$invitante},{$invitato},{$id},'{$code}')");
	
	//$result=array('mail_error'=>$result['error'],'invitato'=>$invitato,'invitante'=>$invitante,'lega'=>$id,"errore"=>mysql_error());
	
 	$result['username']=$username_invitato;
 	$result['id_invito']=mysql_insert_id();
	
	header('Content-Type: application/json');
	echo json_encode($result);
?>
