<?php
  session_start();
  if(!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include 'dbConfig.php';

  if (isset($_POST["add-to-cart"])) {
    $IDprodotto = $_POST["add-to-cart"];
    $quantita = $_POST["quantita"];
    $id_taglia = $_POST["taglia"];

    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
                 $result_user = $conn->query($sql_user);
                 $row_user = $result_user->fetch_assoc();
                 $IDutente = $row_user["IDutente"];

    $sql_selectPT = "SELECT * FROM $prodotto_taglia WHERE idprodotto = $IDprodotto
                     AND idtaglia IN (
                     SELECT IDtaglia FROM $taglia WHERE IDtaglia = '$id_taglia'
                     )";
                    $result_selectPT = $conn->query($sql_selectPT);
                    $row_selectPT = $result_selectPT->fetch_assoc();
                    $IDprodotto_taglia = $row_selectPT["IDprodotto_taglia"];

    $sql_controllo = "SELECT * FROM $carrello WHERE idprodotto_taglia = $IDprodotto_taglia AND idutente = $IDutente";
                      $result_controllo = $conn->query($sql_controllo);
                      $row_controllo = $result_controllo->fetch_assoc();

    $controllo_quantita = ($row_selectPT["quantita"] - $row_controllo["quantita_carrello"]) - $quantita;

        if ($controllo_quantita >= 0) {
          $errore = 'Aggiunto al carrello';

              if(mysqli_num_rows($result_controllo) == 0) {
                  $sql_insert = "INSERT INTO carrello (quantita_carrello, idutente, idprodotto_taglia)
                  VALUES ('$quantita', '$IDutente', '$IDprodotto_taglia')";

                  if ($conn->query($sql_insert)) {
                    session_start();
                    $_SESSION['IDprodotto'] = $IDprodotto;
                    $_SESSION['quantita'] = $quantita;
                    $_SESSION['id_taglia'] = $id_taglia;
                    $_SESSION['errore'] = $errore;
                    header("Location: ./insert.carrello.popup.php");
                  }
                  else
                  {
                    echo "<p class=errore> Errore else nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
                  }
                }


              if(mysqli_num_rows($result_controllo) > 0) {
                  $quantita_da_modificare = $row_controllo["quantita_carrello"];
                  $quantita_modificata = $quantita + $quantita_da_modificare;

                  $sql_update = "UPDATE carrello SET quantita_carrello = $quantita_modificata WHERE idprodotto_taglia = $IDprodotto_taglia AND idutente = $IDutente";

                  if ($conn->query($sql_update)) {
                    session_start();
                    $_SESSION['IDprodotto'] = $IDprodotto;
                    $_SESSION['quantita'] = $quantita;
                    $_SESSION['id_taglia'] = $id_taglia;
                    $_SESSION['errore'] = $errore;
                    header("Location: ./insert.carrello.popup.php");
                  }
                  else
                  {
                    echo "<p class=errore> Errore if nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
                  }
                }
        }

        else {
            $errore = "Non aggiunto al carrello (quantità disponibile {$row_selectPT["quantita"]})";

            session_start();
            $_SESSION['IDprodotto'] = $IDprodotto;
            $_SESSION['quantita'] = $quantita;
            $_SESSION['id_taglia'] = $id_taglia;
            $_SESSION['errore'] = $errore;
            header("Location: ./insert.carrello.popup.php");
        }

    }
 ?>
