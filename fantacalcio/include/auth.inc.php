<?php
include 'dbms.inc.php';

session_start();

function isLogged(){
	return isset($_SESSION['user']);
}
function hasRole($role_name){
	if($role_name!="anonimo"){
		if (isLogged()&&isset($_SESSION['role'])){		
			if ($_SESSION['role']==$role_name)
			return true;
		}
	}
	else{
		return !isLogged();
	}
	return false;
}
function isAuthorized($action){
	$query="SELECT servizi.azione AS service, gruppi.nome AS role
			FROM servizi, permessi, gruppi
			WHERE servizi.id = permessi.servizio
			AND gruppi.id = permessi.gruppo
			AND servizi.azione='{$action}'";
	$result=mysql_query($query);
	$authized=false;
	while ($authorization=mysql_fetch_assoc($result)){
	//echo $action."<br>";
	//echo $_SESSION['role']."<br>";;
	//echo $authorization['role']."<br>";
		if(hasRole($authorization['role']))
			//echo "autorizzato";
			$authized=true;
	}
	return $authized;
	
}
function checkAuthorization($action){

	if(!isAuthorized($action)) {
		header("Location:http://localhost/fantacalcio/error.php?code=403");
		exit();
	}
}
function isLeagueAdmin($id_league,$username){
// 	echo "SELECT * FROM partecipazioni AS p JOIN utenti AS u ON (p.utente=u.id)
// 	WHERE lega={$id_league} AND username='{$username}' AND ruolo=2";
	$result=mysql_query("SELECT * FROM partecipazioni AS p JOIN utenti AS u ON (p.utente=u.id)
			WHERE lega={$id_league} AND username='{$username}' AND ruolo=2");
	if(mysql_num_rows($result)==0){
		return false;
	}
	else{
		return true;
	}
}
function isLeaguePartecipant($id_league,$username){
	// 	echo "SELECT * FROM partecipazioni AS p JOIN utenti AS u ON (p.utente=u.id)
	// 	WHERE lega={$id_league} AND username='{$username}' AND ruolo=2";
	$result=mysql_query("SELECT * FROM partecipazioni AS p JOIN utenti AS u ON (p.utente=u.id)
			WHERE lega={$id_league} AND username='{$username}'");
	if(mysql_num_rows($result)==0){
		return false;
	}
	else{
		return true;
	}
}

function checkIfIsLeagueAdmin($id_league){
	if(!isLeagueAdmin($id_league, $_SESSION['user'])){
		header("Location:http://localhost/fantacalcio/error.php?code=403");
		exit();
	}
}
function checkIfIsLeaguePartecipant($id_league){
	if(!isLeaguePartecipant($id_league, $_SESSION['user'])){
		header("Location:http://localhost/fantacalcio/error.php?code=403");
		exit();
	}
}

?>