<?php
function inviamail($to, $subject, $body) {
	
	require 'PHPMailer/class.phpmailer.php';
	
   	$from = "info@fantaweb.it";
   	
    $from_name = "Fantaweb";
    
    $mail = new PHPMailer();  // creiamo l'oggetto
    
	$mail->IsSMTP(); // abilitiamo l'SMTP
	
	//$mail->SMTPDebug = 1;  // debug: 1 = solo messaggi, 2 = errori e messaggi
	$mail->SMTPAuth = true;  // abilitiamo l'autenticazione
	$mail->SMTPSecure = 'ssl'; // abilitiamo il protocollo ssl richiesto per Gmail
	$mail->Host = 'smtp.gmail.com'; // ecco il server smtp di google
	$mail->Port = 465; // la porta che dobbiamo utilizzare
	$mail->Username = 'daniele.simonetti87@gmail.com'; //email del nostro account gmail
	$mail->Password = 'dasi5787'; //password del nostro account gmail
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error=true;
		$error_message = 'Errore mail: '.$mail->ErrorInfo;
		//$json="{\"error\":true,\"message\":\"".$error_message."\"}";
	} else {
		$error=false;
		$error_message = 'Messaggio inviato!';
		//$json="{\"error\":false,\"message\":\"".$error_message."\"}";
	}
	$result=array();
	$result['error']=$error;
	$result['message']=$error_message;
	return $result;
	//header('Content-Type: application/json');
	//echo $json;
}
?>