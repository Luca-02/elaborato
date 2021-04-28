<?php

  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include 'dbConfig.php';

  if (isset($_POST["btn-conferma-checkout"])) {

    $IDutente = $_POST["btn-conferma-checkout"];

    $nome_completo_ck = mysqli_real_escape_string($conn, $_POST["nome-completo-ck"]);
    $cognome_completo_ck = mysqli_real_escape_string($conn, $_POST["cognome-completo-ck"]);
    $email_ck = mysqli_real_escape_string($conn, $_POST["email-ck"]);
    $indirizzo_ck = mysqli_real_escape_string($conn, $_POST['indirizzo-ck']);
    $citta_ck = mysqli_real_escape_string($conn, $_POST['citta-ck']);
    $provincia_ck = mysqli_real_escape_string($conn, $_POST['provincia-ck']);
    $cap_ck = mysqli_real_escape_string($conn, $_POST['cap-ck']);
    $IDmetodo_pagamento = mysqli_real_escape_string($conn, $_POST['metodo-pagamento']);
    $saldo_speso = mysqli_real_escape_string($conn, $_POST['costo_spesa']);

    $sql_saldoCarta = "SELECT saldo_carta FROM metodo_pagamento WHERE IDmetodo_pagamento = $IDmetodo_pagamento";
                       $result_saldoCarta = $conn->query($sql_saldoCarta);
                       $row_saldoCarta = $result_saldoCarta->fetch_assoc();

   $sql_selectmetodi = "SELECT * FROM metodo_pagamento WHERE IDmetodo_pagamento = $IDmetodo_pagamento";
                        $result_selectmetodi = $conn->query($sql_selectmetodi);
                        $row_selectmetodi = $result_selectmetodi->fetch_assoc();
                        $str_carta = '**** **** **** '.substr($row_selectmetodi["numero_carta"], -4);

    $controllo_saldo_disponibile = $row_saldoCarta["saldo_carta"] - $saldo_speso;

    if ($controllo_saldo_disponibile < 0) //controllo del saldo
    {
      $str_errore = 'Il tuo saldo non è sufficiente, cambiare metodo di pagamento o aggiornare il saldo';
      session_start();
      $_SESSION['str_errore'] = $str_errore;
      $_SESSION['indirizzo_ck'] = $indirizzo_ck;
      $_SESSION['citta_ck'] = $citta_ck;
      $_SESSION['provincia_ck'] = $provincia_ck;
      $_SESSION['cap_ck'] = $cap_ck;
      header("Location: ./checkoutEffettuato.php");
    }
    else
    {
      $str_errore = 'Acquisto andato a buon fine!';

      $sql = "SELECT * FROM carrello WHERE idutente = $IDutente";
      $result = $conn->query($sql);

      while ($row = $result->fetch_assoc()) {
        $quantita_acquisto = $row["quantita_carrello"];
        $idprodotto_taglia = $row["idprodotto_taglia"];

        $sql_insert = "INSERT INTO acquisto
        (quantita_acquisto, data_acquisto, idutente, idprodotto_taglia, nome_spedizione, cognome_spedizione,
          email_spedizione, indirizzo, citta, provincia, cap, numero_carta_utilizzata)
          VALUES
          ('$quantita_acquisto', NOW(), '$IDutente', '$idprodotto_taglia', '$nome_completo_ck', '$cognome_completo_ck',
          '$email_ck', '$indirizzo_ck', '$citta_ck', '$provincia_ck', '$cap_ck', '$str_carta')";

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
                $_SESSION['saldo_speso'] = $saldo_speso;
                $_SESSION['str_errore'] = $str_errore;
                $_SESSION['indirizzo_ck'] = $indirizzo_ck;
                $_SESSION['citta_ck'] = $citta_ck;
                $_SESSION['provincia_ck'] = $provincia_ck;
                $_SESSION['cap_ck'] = $cap_ck;
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


  }

?>
