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

    $sql = "SELECT * FROM Utenti WHERE IDutente = '$IDutente'";
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

      <div class="utente-container">
        <h1> <?php echo "$IDutente - {$row["nome"]} {$row["cognome"]} - {$row["username"]} - {$row["email"]}" ?> </h1>
        <br><br>
        <?php echo "<a href=./viewUser.select.recensioni.php?IDutente=$IDutente>" ?>
          <button type="button" name="recensioni"> Recensioni cliente </button>
        </a>
        <br><br>
        <?php echo "<a href=./viewUser.select.ordini.php?IDutente=$IDutente>" ?>
          <button type="button" name="ordini"> Ordini cliente </button>
        </a>
      </div>

    </form>

  </body>

</html>
