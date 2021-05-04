<!DOCTYPE html>
<html>

  <?php
    session_start();
    if (!isset($_SESSION['email_aziendale'])) {
      header("Location: ./log.php");
    }

    include '../dbConfig/dbConfig.php';

    $email_aziendale = $_SESSION['email_aziendale'];
    $sql_dip = "SELECT * FROM dipendenti WHERE email_aziendale = '$email_aziendale'";
            $result_dip = $conn->query($sql_dip);
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

  <body>

      <div class="header-page">
        <div class="header">
          <p> Accesso effettuato da: <?php echo "{$row_dip["IDdipendente"]} - {$row_dip["nome"]} {$row_dip["cognome"]} - {$row_dip["email_aziendale"]}" ?> </p>
        </div>
        <br>
        <h2> Management area </h2>
        <br>
        <a href="./aggiungiProdotto.php"> <button name="agg-prod"> Aggiungi prodotto </button> </a>
        <a href="./modificaProdotto.php"> <button name="mod-prod" style="margin: 0 10px;"> Modifica prodotto </button> </a>
        <a href="./viewUser.php"> <button name="view-user"> Utenti </button> </a>
        <br><br><hr><br>
      </div>

      <div class="filtri taglia-container2">
        <h1> I tuoi dati </h1>
          <table>
            <tr>
              <td>ID:</td>
              <td><?php echo $row_dip["IDdipendente"] ?></td>
            </tr>
            <tr>
              <td>nome:</td>
              <td><?php echo $row_dip["nome"] ?></td>
            </tr>
            <tr>
              <td>cognome:</td>
              <td><?php echo $row_dip["cognome"] ?></td>
            </tr>
            <tr>
              <td>data di nascita:</td>
              <td><?php echo $row_dip["data_nascita"] ?></td>
            </tr>
            <tr>
              <td>sesso:</td>
              <td><?php echo $row_dip["sesso"] ?></td>
            </tr>
            <tr>
              <td>salario mensile:</td>
              <td><?php echo $row_dip["salario_mensile"] ?></td>
            </tr>
            <tr>
              <td>ore di lavoro settimanali:</td>
              <td><?php echo $row_dip["ore_lavoro_settimanali"] ?></td>
            </tr>
            <tr>
              <td>email aziendale:</td>
              <td><?php echo $row_dip["email_aziendale"] ?></td>
            </tr>
          </table>
      </div>

  </body>

</html>
