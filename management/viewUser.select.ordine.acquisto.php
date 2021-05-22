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
    $IDutente = $_GET["IDutente"];
    $IDordine = $_GET["IDordine"];

    $email_aziendale = $_SESSION['email_aziendale'];
    $sql_dip = "SELECT * FROM dipendenti
                INNER JOIN mansioni ON
                $dipendenti.idmansione = $mansioni.IDmansione
                WHERE email_aziendale = '$email_aziendale'";
                $result_dip = $conn2->query($sql_dip);
                $row_dip = $result_dip->fetch_assoc();
                $iddipendente = $row_dip["IDdipendente"];

    $sql = "SELECT * FROM utenti WHERE IDutente = '$IDutente'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce Management </title>
    <link rel="icon" href="../immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.management.css">
  </head>

  <body >

    <div class="header-page">
      <div class="header">
        <p> Accesso effettuato da: <?php echo "{$row_dip["IDdipendente"]} - {$row_dip["nome"]} {$row_dip["cognome"]} - {$row_dip["email_aziendale"]}" ?> </p>
      </div>
      <br>
      <h2> Management area </h2>
      <br>
      <a href="./managementPage.php"> <button type="button" name="button"> Torna alla home  </button> </a>
      <br><br>
      <?php
        $sqlC = "SELECT * FROM dipendenti WHERE IDdipendente = '$iddipendente'";
                 $resultC = $conn2->query($sqlC);
                 $rowC = $resultC->fetch_assoc();
        if ($rowC["idmansione"] == 4) {
          ?>
            <a href="./aggiungiDipendente.php"> <button name="agg-prod" style="margin-right: 10px;"> Aggiungi dipendente </button> </a>
            <a href="./visualizzaDipendenti.php"> <button name="agg-prod" style="margin-right: 10px;"> Visualizza dipendenti </button> </a>
          <?php
        }

      ?>
      <a href="./aggiungiProdotto.php"> <button name="agg-prod"> Aggiungi prodotto </button> </a>
      <a href="./modificaProdotto.php"> <button name="mod-prod" style="margin: 0 10px;"> Modifica prodotto </button> </a>
      <a href="./viewUser.php"> <button name="view-user"> Utenti </button> </a>
      <br><br><hr><br>
    </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <?php
          $sql_acquisto = "SELECT * FROM acquisto WHERE idordine = '$IDordine'";
                             $result_acquisto = $conn->query($sql_acquisto);

          ?>
          <table class="steelBlueCols">
            <tr>
              <thead>
                <th> IDacquisto </th>
                <th> quantità </th>
                <th> idprodotto_taglia </th>
                <th> titolo prodotto </th>
              </thead>
            </tr>
            <tbody>
          <?php

          while ($row_acquisto = $result_acquisto->fetch_assoc()) {
            $sql_PT = "SELECT * FROM prodotto
                       WHERE IDprodotto IN (
                       SELECT idprodotto FROM prodotto_taglia WHERE idprodotto_taglia = '{$row_acquisto["idprodotto_taglia"]}'
                       )";
                       $result_PT = $conn->query($sql_PT);
                       $row_PT = $result_PT->fetch_assoc();
            ?>
              <tr>
                <td> <?php echo $row_acquisto["IDacquisto"] ?> </td>
                <td> <?php echo $row_acquisto["quantita_acquisto"] ?> </td>
                <td> <?php echo $row_acquisto["idprodotto_taglia"] ?> </td>
                <td> <?php echo $row_PT["titolo"] ?> </td>
              </tr>
            <?php
          }
          ?>
        </tbody>
      </table>

    </form>

  </body>

</html>
