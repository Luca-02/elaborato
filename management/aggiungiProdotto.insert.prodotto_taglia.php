<?php
  session_start();
  if (!isset($_SESSION['email_aziendale'])) {
    header("Location: ./log.php");
  }

  include '../dbConfig/dbConfig.php';

  $idoggetto = $_SESSION['idoggetto'];
  $titolo = $_SESSION['titolo'];
  $produttore = $_SESSION['produttore'];
  $costo = $_SESSION['costo'];
  $colore = $_SESSION['colore'];

  if (isset($_POST["submit-prodotto-taglia"]))
  {
    $sql_insertP = "INSERT INTO prodotto (titolo, idproduttore_prodotto, costo, idoggetto, idcolore_prodotto, data_pubblicazione)
                    VALUES ('$titolo', '$produttore', '$costo', '$idoggetto', '$colore', NOW())";

    if ($conn->query($sql_insertP))
    {
      $sql_idprodotto = "SELECT * FROM prodotto WHERE titolo = '$titolo'";
                         $result_idprodotto = $conn->query($sql_idprodotto);
                         $row_idprodotto = $result_idprodotto->fetch_assoc();
                         $idprodotto = $row_idprodotto["IDprodotto"];

      $sql_taglia = "SELECT * FROM taglia WHERE idtipo_oggetto IN (
                     SELECT IDtipo_oggetto FROM tipo_oggetto WHERE IDtipo_oggetto IN(
                     SELECT idtipo_oggetto FROM calzatura_oggetto WHERE IDcalzatura_oggetto IN (
                     SELECT idcalzatura_oggetto FROM oggetto WHERE IDoggetto = $idoggetto )))
                     ORDER BY IDtaglia";
                     $result_taglia = $conn->query($sql_taglia);

      while ($row_taglia = $result_taglia->fetch_assoc())
      {
        $idtaglia = $row_taglia["IDtaglia"];
        $quantita = $_POST["quantita-$idtaglia"];
        $sql_insertPT = "INSERT INTO prodotto_taglia (quantita, idtaglia, idprodotto) VALUES ('$quantita', '$idtaglia', '$idprodotto')";

        if ($conn->query($sql_insertPT))
        {
        }
        else
        {
          echo "<p class=errore> Errore nell'inserimento while, riprovare: <br>" . $conn->error . "</p>";
        }
      }
      $_SESSION['idprodotto'] = $idprodotto;
      header("Location: ./aggiungiProdotto.insertImg.php");
    }
    else
    {
      echo "<p class=errore> Errore nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
    }
  }

?>
