<!DOCTYPE html>
<html>

  <?php
    session_start();
    // if (!isset($_SESSION['email'])) {
    //   header("Location: ./log.php");
    // }

    include '../dbConfig/dbConfig.php';
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
        <p> Accesso effettuato da: id nome cognome mail </p>
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

      <div class="insert-prodotto">
        nuovo produttore <input type="text" name="produttore" minlength="1" maxlength="30" required> <br><br>
        <button type="submit" name="inserisci-produttore"> Inserisci </button>
      </div>

      <?php
        if (isset($_POST["inserisci-produttore"])) {
          $produttore = strtolower($_POST["produttore"]);
          $sql_insert = "INSERT INTO produttore_prodotto (produttore) VALUES ('$produttore')";
          if ($conn->query($sql_insert)) {
            echo "Produttore inserito correttamente";
          }
          else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
          }
        }
      ?>

    </form>

  </body

</html>
