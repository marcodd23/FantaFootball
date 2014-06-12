<?php 

require './include/mailer.inc.php';
include './include/auth.inc.php';

	//checkAuthorization("user/sendInvite.php");
	//checkIfIsLeagueAdmin($_POST['league_id']);
	
	$email=$_REQUEST['email'];
	$nome=$_REQUEST['name'];
	$message=$_REQUEST['comment'];
	
	$result=inviamail($email, "Fantaweb: messaggio da ".$nome, $message);//richiamiamo la funzione
	
	//echo var_dump($result);
 	if(!$result['error'])	
 	echo "<span class='alert alert-success'><strong>Messaggio inviato!</strong> Ti risponderemo al più presto</span>";
 	else echo "<span class='alert alert-error'><strong>Invio non riuscito:</strong> controlla che l'indirizzo email sia corretto</span>";
?>
