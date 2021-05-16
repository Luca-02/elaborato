<?php
  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include './dbConfig/dbConfig.php';
  include './dbConfig/dbConfig_coupon.php';

    $IDmetodo_pagamento = $_SESSION['IDmetodo_pagamento'];
    $saldo_finale = $_SESSION['saldo_finale'];
    $str_errore = $_SESSION['str_errore'];
    $indirizzo_ck = $_SESSION['indirizzo_ck'];
    $citta_ck = $_SESSION['citta_ck'];
    $provincia_ck = $_SESSION['provincia_ck'];
    $cap_ck = $_SESSION['cap_ck'];
    $latitudine = $_SESSION['latitudine-ck'];
    $longitudine = $_SESSION['longitudine-ck'];
    $altitudine = $_SESSION['altitudine-ck'];

    $sql_saldoCarta = "SELECT saldo_carta FROM metodo_pagamento WHERE IDmetodo_pagamento = $IDmetodo_pagamento";
                       $result_saldoCarta = $conn->query($sql_saldoCarta);
                       $row_saldoCarta = $result_saldoCarta->fetch_assoc();

    $saldo_aggiornato = $row_saldoCarta["saldo_carta"] - $saldo_finale;

    $sql_updateSaldo = "UPDATE metodo_pagamento SET saldo_carta = '$saldo_aggiornato'
                        WHERE IDmetodo_pagamento = '$IDmetodo_pagamento'";

    if ($conn->query($sql_updateSaldo)) {
      session_start();
      $_SESSION['str_errore'] = $str_errore;
      $_SESSION['indirizzo_ck'] = $indirizzo_ck;
      $_SESSION['citta_ck'] = $citta_ck;
      $_SESSION['provincia_ck'] = $provincia_ck;
      $_SESSION['cap_ck'] = $cap_ck;
      $_SESSION['latitudine'] = $latitudine;
      $_SESSION['longitudine'] = $longitudine;
      $_SESSION['altitudine'] = $altitudine;
      header("Location: ./checkoutEffettuato.php");
    }
    else {
      echo "Error updating record: " . mysqli_error($conn);
    }
 ?>
