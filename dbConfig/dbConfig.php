<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "elaboratoluca";

    //tabelle
    $utenti = "utenti";
    $tipo_calzatura = "tipo_calzatura";
    $tipo_oggetto = "tipo_oggetto";
    $calzatura_oggetto = "calzatura_oggetto";
    $calzatura_oggetto = "calzatura_oggetto";
    $oggetto = "oggetto";
    $colore_prodotto = "colore_prodotto";
    $produttore_prodotto = "produttore_prodotto";
    $taglia = "taglia";
    $prodotto = "prodotto";
    $prodotto_taglia = "prodotto_taglia";
    $immagine_prodotto = "immagine_prodotto";
    $recensioni = "recensioni";
    $carrello = "carrello";
    $acquisto = "acquisto";
    $ordine = "ordine";
    $metodo_pagamento = "metodo_pagamento";
    $dipendenti = "dipendenti";
    $giorni = "giorni";
    $orari_lavorativi = "orari_lavorativi";

    $conn = new mysqli($host, $username, $password, $database);
    if($conn->connect_errno) {
      echo "Impossibile connettersi al server:  " . $conn->connect_errno . "\n";
      exit;
    }
 ?>
