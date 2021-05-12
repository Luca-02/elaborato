<?php

  session_start();
  if (!isset($_SESSION['email_aziendale'])) {
    header("Location: ../log.php");
  }

  include '../dbConfig/dbConfig.php';
  include '../dbConfig/dbConfig_dip.php';

  $IDprodotto = $_GET["IDprodotto"];

  if (isset($_POST["cambio-titolo"])) {
    $titolo = $_POST["insert-titolo"];

    $sql_update = "UPDATE $prodotto SET titolo = '$titolo' WHERE IDprodotto = $IDprodotto";

    if ($conn->query($sql_update)) {
      header('location: update.modificaProdotto.php?IDprodotto='. $IDprodotto);
    }
    else {
      echo "Error updating record: " . $conn->error;
    }
  }


  if (isset($_POST["cambio-produttore"])) {
    $idproduttore = $_POST["insert-produttore"];

    $sql_update = "UPDATE $prodotto SET idproduttore_prodotto = '$idproduttore' WHERE IDprodotto = $IDprodotto";

    if ($conn->query($sql_update)) {
      header('location: update.modificaProdotto.php?IDprodotto='. $IDprodotto);
    }
    else {
      echo "Error updating record: " . $conn->error;
    }
  }


  if (isset($_POST["cambio-costo"])) {
    $costo = $_POST["insert-costo"];

    $sql_update = "UPDATE $prodotto SET costo = '$costo' WHERE IDprodotto = $IDprodotto";

    if ($conn->query($sql_update)) {
      header('location: update.modificaProdotto.php?IDprodotto='. $IDprodotto);
    }
    else {
      echo "Error updating record: " . $conn->error;
    }
  }


  if (isset($_POST["cambio-colore"])) {
    $idcolore = $_POST["insert-colore"];

    $sql_update = "UPDATE $prodotto SET idcolore_prodotto = '$idcolore' WHERE IDprodotto = $IDprodotto";

    if ($conn->query($sql_update)) {
      header('location: update.modificaProdotto.php?IDprodotto='. $IDprodotto);
    }
    else {
      echo "Error updating record: " . $conn->error;
    }
  }


  if (isset($_POST["cambio-quantita"])) {
    $idprodotto_taglia = $_POST["cambio-quantita"];
    $quantita = $_POST["insert-quantita-$idprodotto_taglia"];

    $sql_nuovo = "UPDATE prodotto_taglia SET quantita = '$quantita' WHERE IDprodotto_taglia = '$idprodotto_taglia'";

    if ($conn->query($sql_nuovo)) {
      header('location: update.modificaProdotto.php?IDprodotto='. $IDprodotto);
    }
    else {
      echo "Error updating record: " . $conn->error;
    }
  }

?>
