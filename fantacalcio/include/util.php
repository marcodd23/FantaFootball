<?php
 
function AlgoritmoDiBerger($arrSquadre)
 {
 
    $numero_squadre = count($arrSquadre);
    if ($numero_squadre % 2 == 1) {
    	    $arrSquadre[]="BYE";   // numero giocatori dispari? aggiungere un riposo (BYE)!
    	    $numero_squadre++;
    }
   // var_dump($arrSquadre);
    //echo "<br>";
    $giornate = $numero_squadre - 1;
    /* crea gli array per le due liste in casa e fuori */
    for ($i = 0; $i < $numero_squadre /2; $i++) 
    {
        $casa[$i] = $arrSquadre[$i]; 
        $trasferta[$i] = $arrSquadre[$numero_squadre - 1 - $i]; 
 
 
    }
   
    $turni=array();
     for ($i = 0; $i < $giornate; $i++) 
    {
     	 
        /* stampa le partite di questa giornata */
       // echo '<BR>'.($i+1).'a Giornata<BR>';
 
        /* alterna le partite in casa e fuori */
        if (($i % 2) == 0) 
        {
        	$partite=array();
            for ($j = 0; $j < $numero_squadre /2 ; $j++)
            {
                // echo ' '.$trasferta[$j].' - '.$casa[$j].'<BR>';
                 $partita=array("casa"=>$trasferta[$j],"trasferta"=>$casa[$j]);
                 $partite[$j]=$partita;
       	  }
        }
        else 
        {
            for ($j = 0; $j < $numero_squadre /2 ; $j++) 
            {
                 //echo ' '.$casa[$j].' - '.$trasferta[$j].'<BR>';
                 $partita=array("casa"=>$casa[$j],"trasferta"=>$trasferta[$j]);
                 $partite[$j]=$partita;
            }
 
        }      
        $turni[$i+1]=$partite;
        
        // Ruota in gli elementi delle liste, tenendo fisso il primo elemento
        // Salva l'elemento fisso
        $pivot = $casa[0];
 
        /* sposta in avanti gli elementi di "trasferta" inserendo 
           all'inizio l'elemento casa[1] e salva l'elemento uscente in "riporto" */
        array_unshift($trasferta, $casa[1]);
        $riporto = array_pop($trasferta);
 
 
        /* sposta a sinistra gli elementi di "casa" inserendo all'ultimo 
           posto l'elemento "riporto" */
        array_shift($casa);
        array_push($casa, $riporto);
 
        // ripristina l'elemento fisso
        $casa[0] = $pivot ;
    }
    return $turni; 
} 
?>