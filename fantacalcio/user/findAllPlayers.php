<?php
include '../include/auth.inc.php';


$totalItems=0;
$items=array();

$where="";
$order="";
if(isset($_POST['search'])){
	if($_POST['search']!=""){
	$search=$_POST['search'];
	$where.=" AND (g.nome LIKE '%".$search."%' OR g.cognome LIKE '%".$search."%')";
	}
}
if(isset($_POST['role'])){
	if($_POST['role']!=""){
	$role=$_POST['role'];
	$where.=" AND r.nome = '".$role."'";
	}
}
if(isset($_POST['team'])){
	if($_POST['team']!=""){
	$team=$_POST['team'];
	$where.=" AND s.nome = '".$team."'";
	}
}

if(isset($_POST['itemSort'])){
	if($_POST['itemSort']!=""){
	$itemSort=$_POST['itemSort'];
	$order.=" ORDER BY ".$itemSort." ".$_POST['dirSort'];
	}
}
$from=$_POST['itemsForPage']*$_POST['page']-$_POST['itemsForPage'];
$to=$_POST['itemsForPage'];
$limit=" LIMIT ".$from.",".$to;

$baseQuery="SELECT g.id as id,g.nome AS nome, g.cognome AS cognome,g.quotazione as quotazione, r.nome AS ruolo, s.nome AS squadra
					FROM giocatori AS g JOIN (ruoli AS r, squadre AS s) 
					ON ( g.ruolo = r.id AND g.squadra = s.id) WHERE 1=1";
$query=$baseQuery;
if(!$where=="")$query.=$where;
if(!$order=="")$query.=$order;

$result=mysql_query($query);
$totalItems=mysql_num_rows($result);

$result=mysql_query($query.$limit);
$i=0;
while($item=mysql_fetch_assoc($result)){
	$items[$i]=$item;
	$i++;
}
$filterDataResponse=array('totalItems'=>$totalItems,"items"=>$items,"query"=>$query);

header('Content-Type: application/json');
echo json_encode($filterDataResponse);
?>