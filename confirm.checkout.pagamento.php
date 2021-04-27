<?php
  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include 'dbConfig.php';

    $IDmetodo_pagamento = $_SESSION['IDmetodo_pagamento'];
    $saldo_speso = $_SESSION['saldo_speso'];
    $str_errore = $_SESSION['str_errore'];
    $indirizzo_ck = $_SESSION['indirizzo_ck'];
    $citta_ck = $_SESSION['citta_ck'];
    $provincia_ck = $_SESSION['provincia_ck'];
    $cap_ck = $_SESSION['cap_ck'];

    $sql_saldoCarta = "SELECT saldo_carta FROM metodo_pagamento WHERE IDmetodo_pagamento = $IDmetodo_pagamento";
                       $result_saldoCarta = $conn->query($sql_saldoCarta);
                       $row_saldoCarta = $result_saldoCarta->fetch_assoc();

    $saldo_aggiornato = $row_saldoCarta["saldo_carta"] - $saldo_speso;

    $sql_updateSaldo = "UPDATE metodo_pagamento SET saldo_carta = $saldo_aggiornato
                        WHERE IDmetodo_pagamento = $IDmetodo_pagamento";

    if ($conn->query($sql_updateSaldo)) {
      session_start();
      $_SESSION['str_errore'] = $str_errore;
      $_SESSION['indirizzo_ck'] = $indirizzo_ck;
      $_SESSION['citta_ck'] = $citta_ck;
      $_SESSION['provincia_ck'] = $provincia_ck;
      $_SESSION['cap_ck'] = $cap_ck;
      header("Location: ./checkoutEffettuato.php");
    }
    else {
      echo "Error updating record: " . mysqli_error($conn);
    }
 ?>
