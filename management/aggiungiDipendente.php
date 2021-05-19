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


    <form action="./aggiungiDipendente2.php" method="post">

      <div class="insert-prodotto">
        <h2> Aggiungi dipendente </h2> <br>
        nome <input type="text" name="nome" maxlength="30" required>
        <br><br>
        cognome <input type="text" name="cognome" maxlength="30" required>
        <br><br>
        data di nascita <input type="date" name="dataN" required>
        <br><br>
        luogo di nascita <input type="text" name="luogoN" required>
        <br><br>
        sesso
        <select name="sesso" required>
          <option value="" selected disabled> Seleziona sesso </option>
          <option value="M"> M </option>
          <option value="F"> F </option>
        </select>
        <br><br>
        sigla provincia <input type="text" name="siglaP" maxlength="2" required>
        <br><br>
        codice fiscale <input type="text" name="codiceF" maxlength="16" required>
        <br><br>
        salario mensile <input type="number" name="salario" step=".01" required>
        <br><br>
        ore di lavoro settimanali <input type="number" name="oreL" required>
        <br><br>
        mail personale <input type="text" name="mailP" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        <br><br>
        mail aziendale <input type="text" name="mailA" pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
        <br><br>
        password aziendale <input type="text" name="passwordA" minlength="8" required>
        <br><br>
        mansione
        <select name="mansione" required>
          <option value="" selected disabled> Seleziona mansione </option>
          <?php
          $sql_man = "SELECT * FROM mansioni";
          $result_man = $conn2->query($sql_man);

          while ($row_man = $result_man->fetch_assoc()) {
            echo "<option class=option-style value={$row_man["IDmansione"]}> {$row_man["mansione"]} </option>";
          }
          ?>
        </select>
        <br><br>



        <table border="1" class="orari">
          <tr>
            <th> # </th>
            <?php
              $sql_gg = "SELECT * FROM giorni ORDER BY idgiorno";
                         $result_gg = $conn2->query($sql_gg);

               while($row_gg = $result_gg->fetch_assoc()) {
                 echo "<th> {$row_gg['giorno']} </th>";
               }
            ?>
          </tr>
          <tr>
            <td> Ora di inizio </td>
            <td> <input type="time" name="orarioI_1"> </td>
            <td> <input type="time" name="orarioI_2"> </td>
            <td> <input type="time" name="orarioI_3"> </td>
            <td> <input type="time" name="orarioI_4"> </td>
            <td> <input type="time" name="orarioI_5"> </td>
            <td> <input type="time" name="orarioI_6"> </td>
            <td> <input type="time" name="orarioI_7"> </td>
          </tr>
          <tr>
            <td> Ora di fine </td>
            <td> <input type="time" name="orarioF_1"> </td>
            <td> <input type="time" name="orarioF_2"> </td>
            <td> <input type="time" name="orarioF_3"> </td>
            <td> <input type="time" name="orarioF_4"> </td>
            <td> <input type="time" name="orarioF_5"> </td>
            <td> <input type="time" name="orarioF_6"> </td>
            <td> <input type="time" name="orarioF_7"> </td>
        </table>
        <br>
        <button type="submit" name="conferma"> conferma nuovo dipendente </button>
      </div>

    </form>

  </body>

</html>
