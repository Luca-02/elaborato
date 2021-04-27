<?php

  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include 'dbConfig.php';

  if (isset($_POST["conferma-aggiungi-metodoP"])) {

    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
    $result_user = $conn->query($sql_user);
    $row_user = $result_user->fetch_assoc();
    $IDutente = $row_user["IDutente"];

    $nome_intestatario_ck = $_POST["nome-intestatario-ck"];
    $cognome_intestatario_ck = $_POST["cognome-intestatario-ck"];
    $numero_carta_ck = $_POST["numero-carta-ck"];
    $mese_scadenza_ck = $_POST["mese-scadenza-ck"];
    $anno_scadenza_ck = $_POST["anno-scadenza-ck"];
    $cvv_ck = $_POST["cvv-ck"];

    $sql_insert = "INSERT INTO metodo_pagamento (nome_intestatario, cognome_intestatario, numero_carta, anno_scadenza, mese_scadenza, cvv, idutente, saldo_carta)
    VALUES ('$nome_intestatario_ck', '$cognome_intestatario_ck', '$numero_carta_ck', '$mese_scadenza_ck', '$anno_scadenza_ck', '$cvv_ck', '$IDutente', '10000')";

    if ($conn->query($sql_insert)) {
      header("Location: ./metodiPagamento.php");
    }
    else {
      echo "<p class=errore> Errore nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
    }

  }


 ?>
