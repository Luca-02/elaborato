<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "elaboratoluca_dip";

    //tabelle
    $dipendenti = "dipendenti";
    $giorni = "giorni";
    $orari_lavorativi = "orari_lavorativi";

    $conn2 = new mysqli($host, $username, $password, $database);
    if($conn2->connect_errno) {
      echo "Impossibile connettersi al server:  " . $conn2->connect_errno . "\n";
      exit;
    }
 ?>
