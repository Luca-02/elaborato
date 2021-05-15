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

    $coupon_text = $_SESSION['coupon_text'];

    if ($coupon_text == 0) {
      $saldo_finale = $saldo_speso;
      $_SESSION['saldo_finale'] = $saldo_finale;
    }
    else {
      $sql2 = "SELECT * FROM coupon WHERE codice = '$coupon_text'";
      $result2 = $conn3->query($sql2);
      $row2 = $result2->fetch_assoc();
      $IDcoupon = $row2["IDcoupon"];
      $tipo_sconto = $row2["idtipo_sconto"];

      if ($tipo_sconto == 1) {
        $saldo_finale = $saldo_speso - (($saldo_speso/100)*$row2["valore"]);
      }
      else {
        $saldo_finale = $saldo_speso - $row2["valore"];
      }

      $utilizzi_agg = $row2["utilizzi"] - 1;
      $sql_updtC = "UPDATE coupon SET utilizzi = '$utilizzi_agg' WHERE IDcoupon = '$IDcoupon'";

      if ($conn3->query($sql_updtC) === TRUE) {
      }
      else {
        echo "Error updating record: " . $conn->error;
      }

      $_SESSION['saldo_finale'] = $saldo_finale;
    }

    //

    $sql_saldoCarta = "SELECT saldo_carta FROM metodo_pagamento WHERE IDmetodo_pagamento = $IDmetodo_pagamento";
                       $result_saldoCarta = $conn->query($sql_saldoCarta);
                       $row_saldoCarta = $result_saldoCarta->fetch_assoc();

   $sql_selectmetodi = "SELECT * FROM metodo_pagamento WHERE IDmetodo_pagamento = $IDmetodo_pagamento";
                        $result_selectmetodi = $conn->query($sql_selectmetodi);
                        $row_selectmetodi = $result_selectmetodi->fetch_assoc();
                        $str_carta = '**** **** **** '.substr($row_selectmetodi["numero_carta"], -4);

    $controllo_saldo_disponibile = $row_saldoCarta["saldo_carta"] - $saldo_finale;



    if ($controllo_saldo_disponibile < 0) //controllo del saldo
    {
      $str_errore = 'Il tuo saldo non è sufficiente, cambiare metodo di pagamento o aggiornare il saldo';
      session_start();
      $_SESSION['str_errore'] = $str_errore;
      $_SESSION['indirizzo_ck'] = $indirizzo_ck;
      $_SESSION['citta_ck'] = $citta_ck;
      $_SESSION['provincia_ck'] = $provincia_ck;
      $_SESSION['cap_ck'] = $cap_ck;
      $_SESSION['latitudine'] = $latitudine;
      $_SESSION['longitudine'] = $longitudine;
      $_SESSION['altitudine'] = $altitudine;
      $_SESSION['saldo_finale'] = $saldo_finale;
      header("Location: ./checkoutEffettuato.php");
    }
    else
    {
      $str_errore = 'Acquisto andato a buon fine!';

      $sql_insert_ordine = "INSERT INTO ordine
                            (nome_destinatario, cognome_destinatario, email_destinatario, indirizzo, citta, provincia, cap,
                             numero_carta_utilizzata, data_ordine, latitudine, longitudine, altitudine, idutente)
                            VALUES
                            ('$nome_completo_ck', '$cognome_completo_ck', '$email_ck', '$indirizzo_ck', '$citta_ck', '$provincia_ck', '$cap_ck',
                             '$str_carta', NOW(), '$latitudine', '$longitudine', '$altitudine', '$IDutente')";

      if ($conn->query($sql_insert_ordine)) {

        $sql_ordine_desc = "SELECT * FROM ordine where idutente = '$IDutente' order by data_ordine DESC LIMIT 1";
                            $result_ordine_desc = $conn->query($sql_ordine_desc);
                            $row_ordine_desc = $result_ordine_desc->fetch_assoc();
                            $IDordine = $row_ordine_desc["IDordine"];

        $sql = "SELECT * FROM carrello WHERE idutente = '$IDutente'";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
          $quantita_acquisto = $row["quantita_carrello"];
          $idprodotto_taglia = $row["idprodotto_taglia"];

          $sql_insert = "INSERT INTO acquisto
                         (quantita_acquisto, idprodotto_taglia, idordine)
                         VALUES
                         ('$quantita_acquisto', '$idprodotto_taglia', '$IDordine')";

            if ($conn->query($sql_insert))
            {
              $sql_quantitaPT = "SELECT * FROM prodotto_taglia WHERE IDprodotto_taglia = $idprodotto_taglia";
              $result_quantitaPT = $conn->query($sql_quantitaPT);
              $row_quantitaPT = $result_quantitaPT->fetch_assoc();

              $quantita_aggiornata = $row_quantitaPT["quantita"] - $quantita_acquisto;

              $sql_updateQ = "UPDATE prodotto_taglia SET quantita = '$quantita_aggiornata'
                              WHERE $prodotto_taglia.IDprodotto_taglia = $idprodotto_taglia";
                if ($conn->query($sql_updateQ))
                {
                  $sql_delete = "DELETE FROM carrello WHERE idprodotto_taglia = $idprodotto_taglia";

                  if ($conn->query($sql_delete)) {
                    session_start();
                    $_SESSION['IDmetodo_pagamento'] = $IDmetodo_pagamento;
                    $_SESSION['saldo_finale'] = $saldo_finale;
                    $_SESSION['str_errore'] = $str_errore;
                    $_SESSION['indirizzo_ck'] = $indirizzo_ck;
                    $_SESSION['citta_ck'] = $citta_ck;
                    $_SESSION['provincia_ck'] = $provincia_ck;
                    $_SESSION['cap_ck'] = $cap_ck;
                    $_SESSION['latitudine'] = $latitudine;
                    $_SESSION['longitudine'] = $longitudine;
                    $_SESSION['altitudine'] = $altitudine;
                    header("Location: ./confirm.checkout.pagamento.php");
                  }
                  else {
                    echo "Error deleting record: " . mysqli_error($conn);
                  }
                }
                else
                {
                  echo "Error updating record: " . $conn->error;
                }

            }
            else
            {
              echo "<p class=errore> Errore nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
            }
          }

      }
      else
      {
        echo "<p class=errore> Errore nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
      }

    }

?>
