<?php

  session_start();
  if (!isset($_SESSION['email_aziendale'])) {
    header("Location: ../log.php");
  }

  include '../dbConfig/dbConfig.php';
  include '../dbConfig/dbConfig_dip.php';

  $idoggetto = $_SESSION['idoggetto'];

  if (isset($_POST["submit-prodotto"])) {
    $idoggetto = $_POST["submit-prodotto"];
    $titolo = strtolower($_POST["insert-titolo"]);
    $produttore = $_POST["insert-produttore"];
    $costo = $_POST["insert-costo"];
    $colore = $_POST["insert-colore"];

    session_start();
    $_SESSION['idoggetto'] = $idoggetto;
    $_SESSION['titolo'] = $titolo;
    $_SESSION['produttore'] = $produttore;
    $_SESSION['costo'] = $costo;
    $_SESSION['colore'] = $colore;
    header("Location: ./aggiungiProdotto.insert.prodotto.php");
  }

?>
