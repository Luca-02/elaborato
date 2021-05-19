<?php
session_start();
if (!isset($_SESSION['email_aziendale'])) {
  header("Location: ../log.php");
}

include ("../dbConfig/dbConfig.php");
include ("../dbConfig/dbConfig_dip.php");
?>
<!DOCTYPE html>
<html>

  <?php
    $email_aziendale = $_SESSION['email_aziendale'];
    $sql_dip = "SELECT * FROM dipendenti WHERE email_aziendale = '$email_aziendale'";
            $result_dip = $conn2->query($sql_dip);
            $row_dip = $result_dip->fetch_assoc();
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
      <a href="../logout.php"> <button type="button" name="button"> Logout </button> </a>
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

      <br>

      <table class="steelBlueCols">
        <tr>
          <thead>
            <th> <button name="ordina-utenti-c" value="IDdipendente"> IDdipendente CRESC</button> </th>
            <th> <button name="ordina-utenti-c" value="nome"> nome CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="cognome"> cognome CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="data_nascita"> data_nascita CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="codice_fiscale"> codice_fiscale CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="salario_mensile"> salario CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="email_personale"> mail personale CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="email_aziendale"> mail aziendale CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="idmansione"> idmansione CRESC</button></th>
          </thead>
          <thead>
            <th> <button name="ordina-utenti-d" value="IDdipendente"> IDdipendente DESC</button> </th>
            <th> <button name="ordina-utenti-d" value="nome"> nome DESC</button></th>
            <th> <button name="ordina-utenti-d" value="cognome"> cognome DESC</button></th>
            <th> <button name="ordina-utenti-d" value="data_nascita"> data_nascita DESC</button></th>
            <th> <button name="ordina-utenti-d" value="codice_fiscale"> codice fiscale DESC</button></th>
            <th> <button name="ordina-utenti-d" value="salario_mensile"> salario DESC</button></th>
            <th> <button name="ordina-utenti-d" value="email_personale"> mail personale DESC</button></th>
            <th> <button name="ordina-utenti-d" value="email_aziendale"> mail aziendale DESC</button></th>
            <th> <button name="ordina-utenti-d" value="idmansione"> idmansione DESC</button></th>
          </thead>
        </tr>

        <tbody>
          <?php

            if (!isset($_POST["ordina-utenti"]) || isset($_POST["resetta-filtri"])) {
              $sql = "SELECT * FROM dipendenti";
            }
            if (isset($_POST["ordina-utenti-c"])) {
              $str = $_POST["ordina-utenti-c"];
              $sql = "SELECT * FROM dipendenti ORDER BY $str";
            }
            if (isset($_POST["ordina-utenti-d"])) {
              $str = $_POST["ordina-utenti-d"];
              $sql = "SELECT * FROM dipendenti ORDER BY $str DESC";
            }

          $result = $conn2->query($sql);

          while($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td> <?php echo $row["IDdipendente"] ?> </td>
                <td> <?php echo $row["nome"] ?> </td>
                <td> <?php echo $row["cognome"] ?> </td>
                <td> <?php echo $row["data_nascita"] ?> </td>
                <td> <?php echo $row["codice_fiscale"] ?> </td>
                <td> <?php echo $row["salario_mensile"] ?> </td>
                <td> <?php echo $row["email_personale"] ?> </td>
                <td> <?php echo $row["email_aziendale"] ?> </td>
                <td> <?php echo $row["idmansione"] ?> </td>
              </tr>
            <?php
          }
            $sql_cont = "SELECT count(*) as cont_utenti FROM prodotto";
            $result_cont = $conn->query($sql_cont);
            $row_cont = $result_cont->fetch_assoc();
          ?>
            </tbody>
            <tfoot>
              <tr>
                <th> TOT <?php echo $row_cont["cont_utenti"] ?> prodotti </th>
              </tr>
            </tfoot>
          <?php
          ?>
      </table>

    </form>

  </body>

</html>
