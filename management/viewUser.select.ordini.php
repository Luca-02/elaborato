<?php
session_start();
if (!isset($_SESSION['email_aziendale'])) {
  header("Location: ../log.php");
}

include '../dbConfig/dbConfig.php';
?>
<!DOCTYPE html>
<html>

  <?php
    $IDutente = $_GET["IDutente"];

    $email_aziendale = $_SESSION['email_aziendale'];
    $sql_dip = "SELECT * FROM dipendenti WHERE email_aziendale = '$email_aziendale'";
            $result_dip = $conn->query($sql_dip);
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
          $sql_ordini = "SELECT * FROM ordine WHERE idutente = '$IDutente' ORDER BY data_ordine";
                             $result_ordini = $conn->query($sql_ordini);

          ?>
          <table class="steelBlueCols">
            <tr>
              <thead>
                <th> IDordine </th>
                <th> nome destinatario </th>
                <th> cognome destinatario </th>
                <th> email destinatario </th>
                <th> indirizzo </th>
                <th> citta </th>
                <th> provincia </th>
                <th> CAP </th>
                <th> carta utilizzata </th>
                <th> data ordine </th>
                <th> # </th>
              </thead>
            </tr>
            <tbody>
          <?php

          while ($row_ordini = $result_ordini->fetch_assoc()) {
            ?>
              <tr>
                <td> <?php echo $row_ordini["IDordine"] ?> </td>
                <td> <?php echo $row_ordini["nome_destinatario"] ?> </td>
                <td> <?php echo $row_ordini["cognome_destinatario"] ?> </td>
                <td> <?php echo $row_ordini["email_destinatario"] ?> </td>
                <td> <?php echo $row_ordini["indirizzo"] ?> </td>
                <td> <?php echo $row_ordini["citta"] ?> </td>
                <td> <?php echo $row_ordini["provincia"] ?> </td>
                <td> <?php echo $row_ordini["cap"] ?> </td>
                <td> <?php echo $row_ordini["numero_carta_utilizzata"] ?> </td>
                <td> <?php echo $row_ordini["data_ordine"] ?> </td>
                <td class="text-a">
                  <?php echo "<a href=./viewUser.select.ordine.acquisto.php?IDutente={$row['IDutente']}&IDordine={$row_ordini["IDordine"]}>" ?>
                    seleziona
                  </a>
                </td>
              </tr>
            <?php
          }
          ?>
        </tbody>
      </table>

    </form>

  </body>

</html>
