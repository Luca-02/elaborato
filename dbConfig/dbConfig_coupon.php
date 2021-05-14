<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "elaboratoluca_coupon";

    //tabelle
    $coupon = "coupon";
    $tipo_sconto = "tipo_sconto";

    $conn3 = new mysqli($host, $username, $password, $database);
    if($conn3->connect_errno) {
      echo "Impossibile connettersi al server:  " . $conn3->connect_errno . "\n";
      exit;
    }
 ?>
