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
      <a href="./managementPage.php"> <button name="management-page"> Torna alla home </button> </a>
      <br><br>
      <a href="./aggiungiProdotto.php"> <button name="agg-prod"> Aggiungi prodotto </button> </a>
      <a href="./modificaProdotto.php"> <button name="mod-prod" style="margin: 0 10px;"> Modifica prodotto </button> </a>
      <a href="./viewUser.php"> <button name="view-user"> Utenti </button> </a>
      <br><br><hr><br>
    </div>


    <form action="./aggiungiProdotto.prodotto.php" method="post">

      <div class="insert-prodotto">

        <?php

          if (isset($_POST["conferma-tipo_oggetto_calzatura"]))
          {
            $idtipo_calzatura = $_POST["seleziona-tipo_calzatura"];
            $idtipo_oggetto = $_POST["seleziona-tipo_oggetto"];
            ?>
              tipo_calzatura = <?php echo $idtipo_calzatura ?>
              tipo_oggetto = <?php echo $idtipo_oggetto ?>
              <br><br>

              <h2> Selezione dell'oggetto </h2> <br>

              oggetto
                <select name="seleziona-oggetto" required>
                  <option value="" selected disabled> Seleziona oggetto </option>
                  <?php
                    $sql_oggetto = "SELECT * FROM oggetto WHERE idcalzatura_oggetto IN (
                                    SELECT IDcalzatura_oggetto FROM calzatura_oggetto WHERE idtipo_calzatura = '$idtipo_calzatura' AND idtipo_oggetto = '$idtipo_oggetto'
                                    )";
                                    $result_oggetto = $conn->query($sql_oggetto);

                    while ($row_oggetto = $result_oggetto->fetch_assoc()) {
                      echo "<option value={$row_oggetto["IDoggetto"]}> {$row_oggetto["nome_oggetto"]} </option>";
                    }
                   ?>
                </select>
              <br><br>
              <button type="submit" name="conferma-oggetto"> conferma oggetto </button>
            <?php
          }
        ?>
      </div>

    </form>

  </body>

</html>
