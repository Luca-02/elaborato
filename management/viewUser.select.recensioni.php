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

    $email_aziendale = $_SESSION['email_aziendale'];
    $sql_dip = "SELECT * FROM dipendenti WHERE email_aziendale = '$email_aziendale'";
            $result_dip = $conn2->query($sql_dip);
            $row_dip = $result_dip->fetch_assoc();

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
        <a href="./managementPage.php"> <button name="management-page"> Torna alla home </button> </a>
        <br><br>
        <a href="./aggiungiProdotto.php"> <button name="agg-prod"> Aggiungi prodotto </button> </a>
        <a href="./modificaProdotto.php"> <button name="mod-prod" style="margin: 0 10px;"> Modifica prodotto </button> </a>
        <a href="./viewUser.php"> <button name="view-user"> Utenti </button> </a>
        <br><br><hr><br>
      </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <?php
          $sql_recensioni = "SELECT * FROM recensioni WHERE idutente = '$IDutente' ORDER BY data_recensione";
                             $result_recensioni = $conn->query($sql_recensioni);

          ?>
          <table class="steelBlueCols">
            <tr>
              <thead>
                <th> IDrecensione </th>
                <th> titolo recensione </th>
                <th> testo recensione </th>
                <th> valutazione </th>
                <th> data recensione </th>
                <th> idprodotto </th>
              </thead>
            </tr>
            <tbody>
          <?php

          while ($row_recensioni = $result_recensioni->fetch_assoc()) {
            ?>
              <tr>
                <td> <?php echo $row_recensioni["IDrecensione"] ?> </td>
                <td> <?php echo $row_recensioni["titolo_recensione"] ?> </td>
                <td> <?php echo $row_recensioni["testo_recensione"] ?> </td>
                <td> <?php echo $row_recensioni["valutazione"] ?> </td>
                <td> <?php echo $row_recensioni["data_recensione"] ?> </td>
                <td> <?php echo $row_recensioni["idprodotto"] ?> </td>
              </tr>
            <?php
          }
          ?>
        </tbody>


    </form>

  </body>

</html>
