<?php
  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include './dbConfig/dbConfig.php';
  include './dbConfig/dbConfig_coupon.php';

  $IDutente = $_SESSION['IDutente'];

  $nome_completo_ck = $_SESSION['nome_completo_ck'];
  $cognome_completo_ck = $_SESSION['cognome_completo_ck'];
  $email_ck = $_SESSION['email_ck'];
  $indirizzo_ck = $_SESSION['indirizzo_ck'];
  $citta_ck = $_SESSION['citta_ck'];
  $provincia_ck = $_SESSION['provincia_ck'];
  $cap_ck = $_SESSION['cap_ck'];
  $latitudine = $_SESSION['latitudine'];
  $longitudine = $_SESSION['longitudine'];
  $altitudine = $_SESSION['altitudine'];

  $IDmetodo_pagamento = $_SESSION['IDmetodo_pagamento'];
  $saldo_speso = $_SESSION['saldo_speso'];

  $spedizione = $_SESSION['spedizione'];

  $coupon_text = $_SESSION['coupon_text'];


  $sql = "SELECT * FROM coupon WHERE codice = '$coupon_text'";
          $result = $conn3->query($sql);
          $conta = $result->num_rows;

  if ($conta > 0) {
    header("Location: ./conferma.acquisto.php");
  }
  else {
    header("Location: ./conferma.acquisto.php");
  }

?>
