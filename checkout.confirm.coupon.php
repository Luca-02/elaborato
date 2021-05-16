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

  $coupon_text = $_POST['coupon-text'];

  $sql = "SELECT * FROM coupon WHERE codice = '$coupon_text' AND utilizzi > 0 AND minimo_spesa <= '$saldo_speso'";
          $result = $conn3->query($sql);

  if ($row = $result->fetch_assoc()) {
    session_start();
    $_SESSION['coupon_text'] = $coupon_text;
    header("Location: ./checkout.contoFinale.php");
  }
  else {
    header("Location: ./checkout.check.coupon.fail.php");
  }

?>
