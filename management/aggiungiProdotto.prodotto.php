<?php
session_start();
if (!isset($_SESSION['email_aziendale'])) {
  header("Location: ../log.php");
}

include '../dbConfig/dbConfig.php';
include '../dbConfig/dbConfig_dip.php';
?>
<!DOCTYPE html>
<html>

  <?php

    $idoggetto = $_POST["seleziona-oggetto"];

    $email_aziendale = $_SESSION['email_aziendale'];
    $sql_dip = "SELECT * FROM dipendenti WHERE email_aziendale = '$email_aziendale'";
            $result_dip = $conn2->query($sql_dip);
            $row_dip = $result_dip->fetch_assoc();

    $sql_oggetto = "SELECT * FROM oggetto WHERE IDoggetto = '$idoggetto'";
                    $result_oggetto = $conn->query($sql_oggetto);
                    $row_oggetto = $result_oggetto->fetch_assoc();
  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce Management </title>
    <link rel="icon" href="../immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.management.css">
  </head>

  <body>

    <div class="header-page">
      <div class="header">
        <p> Accesso effettuato da: <?php echo "{$row_dip["IDdipendente"]} - {$row_dip["nome"]} {$row_dip["cognome"]} - {$row_dip["email_aziendale"]}" ?> </p>
      </div>
      <br>
      <h2> Management area </h2>
      <br>
      <a href="./managementPage.php"> <button name="management-page"> Torna alla home </button> </a>
      <br><br>
      <a href="./aggiungiProdotto.php"> <button name="agg-prod"> Aggiungi prodotto </button> </a>
      <a href="./modificaProdotto.php"> <button name="mod-prod" style="margin: 0 10px;"> Modifica prodotto </button> </a>
      <a href="./viewUser.php"> <button name="view-user"> Utenti </button> </a>
      <br><br><hr><br>
    </div>


    <form action="./aggiungiProdotto.confirm.prodotto.php" method="post">

      <div class="insert-prodotto">
        <h1> <?php echo $row_oggetto["nome_oggetto"] ?> </h1>

        <table class="table-insert1">
          <tr>
            <td>titolo</td>
            <td><textarea name="insert-titolo" minlength="5" maxlength="50" rows="1" cols="60"></textarea></td>
            <td></td>
          </tr>
          <tr>
            <td>produttore</td>
            <td>
              <select name="insert-produttore">
                <option value="" selected disabled> Seleziona produttore </option>
                <?php
                  $sql_produttore = "SELECT * FROM produttore_prodotto ORDER BY produttore";
                                     $result_produttore = $conn->query($sql_produttore);

                  while ($row_produttore = $result_produttore->fetch_assoc()) {
                    echo "<option class=option-style value={$row_produttore["IDproduttore_prodotto"]}> {$row_produttore["produttore"]} </option>";
                  }
                ?>
              </select>
            </td>
            <td> <a href="./aggiungiProduttore.php"> <button type="button" name="button"> aggiungi nuovo produttore </button> </a> </td>
          </tr>
          <tr>
            <td>costo</td>
            <td><input type="number" name="insert-costo" step=".01"></td>
            <td></td>
          </tr>
          <tr>
            <td>colore</td>
            <td>
              <select name="insert-colore">
                <option value="" selected disabled> Seleziona colore </option>
                <?php
                  $sql_colore = "SELECT * FROM colore_prodotto ORDER BY nome_colore";
                                 $result_colore = $conn->query($sql_colore);

                  while ($row_colore = $result_colore->fetch_assoc()) {
                    echo "<option class=option-style value={$row_colore["IDcolore_prodotto"]}> {$row_colore["nome_colore"]} - {$row_colore["codice_colore"]} </option>";
                  }
                ?>
              </select>
            </td>
            <td> <a href="./aggiungiColore.php"> <button type="button" name="button"> aggiungi nuovo colore </button> </a> </td>
          </tr>
        </table>

        <br>

        <button type="submit" name="submit-prodotto" value="<?php echo $idoggetto ?>"> Conferma </button>

      </div>

    </form>

  </body>

</html>
