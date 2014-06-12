<?php

$connection = mysql_pconnect("localhost", "root", "root") or
        die(mysql_error());

mysql_select_db("fantacalcio", $connection) or
        die(mysql_error());
?>