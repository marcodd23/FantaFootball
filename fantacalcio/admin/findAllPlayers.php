<?php
/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
*/
	$aColumns = array( 'cognome', 'nome', 'quotazione', 'ruolo', 'squadra' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "id";
	
	/* DB table to use */
	$sTable = "giocatori";
	
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
	
	$sSearch=$_GET['sSearch'];
	//$sSearch="buf";
	if($sSearch=="")$sWhere="";
	else $sWhere=" where g.nome LIKE '%".$sSearch."%' 
					or g.cognome LIKE '%".$sSearch."%'
					or g.quotazione LIKE '%".$sSearch."%'
					or r.nome LIKE '%".$sSearch."%'
					or s.nome LIKE '%".$sSearch."%' ";
	$presearch=$_GET['preSearch'];
	if($presearch!=""){
	$sWhere=" where (g.nome LIKE '%".$sSearch."%' 
					or g.cognome LIKE '%".$sSearch."%'
					or g.quotazione LIKE '%".$sSearch."%'
					or r.nome LIKE '%".$sSearch."%')
					and s.nome LIKE '".$presearch."' ";
	}
	$sQuery ="
		SELECT SQL_CALC_FOUND_ROWS g.id as id, g.cognome as cognome, g.nome as nome, g.quotazione as quotazione,
		r.nome as ruolo, s.nome as squadra
		FROM   $sTable AS g JOIN (ruoli AS r,squadre AS s) ON (g.ruolo=r.id AND g.squadra=s.id) 
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
		$row[5]="<a href='playerform.php?id=".$aRow[0]."'><i class='icon-edit'></i></a>| 
		      <a href='playerform.php?action=delete&id=".$aRow[0]."'><i class='icon-trash'></i></a>";
		$output['aaData'][] = $row;
		//print_r ($row);
	}
	
	echo json_encode( $output );
?>