<?php
/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
*/
	$aColumns = array( 'nome', 'voto', 'gf', 'gs','ass','ag','amm','esp','rp','rs','gv','gp' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id";
	
	/* DB table to use */
	$sTable = "voti";
	
	/* Database connection information */
	$gaSql['user']       = "root";
	$gaSql['password']   = "root";
	$gaSql['db']         = "fantacalcio";
	$gaSql['server']     = "localhost";
	
	
	/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
	 * If you just want to use the basic configuration for DataTables with PHP server-side, there is
	 * no need to edit below this line
	 */
	
	/* 
	 * MySQL connection
	 */
	$gaSql['link'] =  mysql_pconnect( $gaSql['server'], $gaSql['user'], $gaSql['password']  ) or
		die( 'Could not open connection to server' );
	
	mysql_select_db( $gaSql['db'], $gaSql['link'] ) or 
		die( 'Could not select database '. $gaSql['db'] );
	
	
	/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysql_real_escape_string( $_GET['iDisplayStart'] ).", ".
			mysql_real_escape_string( $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	$sWhere=" where giornata = ".$_GET['giornata'];
	$sSearch=$_GET['sSearch'];
	//$sSearch="buf";
	if($sSearch=="")$sWhere.="";
	else $sWhere.=" and g.cognome LIKE '%".$sSearch."%'";
	$presearch=$_GET['preSearch'];
	if($presearch!=""){
	$sWhere.=" and (g.nome LIKE '%".$sSearch."%'";
	}
	$sQuery ="
		SELECT SQL_CALC_FOUND_ROWS v.id as id, 
		CONCAT(g.cognome,' ',g.nome) as nome, 
		v.voto as voto,v.gol_fatto as gf,v.gol_subito as gs,v.assist as ass,
		v.autogol as ag, v.ammonizione as amm, v.espulsione as esp, v.rigore_parato as rp,
		v.rigore_sbagliato as rs, v.gol_partita as gv,v.gol_pareggio as gp
		FROM   $sTable AS v JOIN giocatori AS g ON v.giocatore=g.id 
		$sWhere 
		$sOrder
		$sLimit
	";
	//echo($sQuery)."<br/>";
	$rResult = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultFilterTotal = mysql_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = mysql_query( $sQuery, $gaSql['link'] ) or die(mysql_error());
	$aResultTotal = mysql_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysql_fetch_array( $rResult ) )
	{
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ];
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
			}
		}
// 		$row[6]="<a href='userform.php?id=".$aRow[0]."'><i class='icon-edit'></i></a>| 
// 		      <a href='userform.php?action=delete&id=".$aRow[0]."'><i class='icon-trash'></i></a>";
		$output['aaData'][] = $row;
		//print_r ($row);
	}
	
	echo json_encode( $output );
?>