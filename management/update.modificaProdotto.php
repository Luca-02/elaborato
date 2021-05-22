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
    $IDprodotto = $_GET["IDprodotto"];

    $email_aziendale = $_SESSION['email_aziendale'];
    $sql_dip = "SELECT * FROM dipendenti
                INNER JOIN mansioni ON
                $dipendenti.idmansione = $mansioni.IDmansione
                WHERE email_aziendale = '$email_aziendale'";
                $result_dip = $conn2->query($sql_dip);
                $row_dip = $result_dip->fetch_assoc();
                $iddipendente = $row_dip["IDdipendente"];

    $sql = "SELECT * FROM prodotto
            INNER JOIN oggetto
            ON $prodotto.idoggetto = $oggetto.idoggetto
            INNER JOIN colore_prodotto
            ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
            INNER JOIN produttore_prodotto
            ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
            INNER JOIN $immagine_prodotto
            ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
            WHERE IDprodotto = '$IDprodotto'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $imageURL = '../uploads/'.$row["file_name"];

    $sql2 = "SELECT * FROM prodotto_taglia WHERE idprodotto = '$IDprodotto'";
             $result2 = $conn->query($sql2);
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

    <form action="confirm.update.modificaProdotto.php?IDprodotto=<?php echo $IDprodotto ?>" method="post">

      <table class="steelBlueCols">
        <tr>
          <thead>
            <th> IDprodotto </th>
            <th> titolo </th>
            <th> produttore </th>
            <th> costo </th>
            <th> nome_oggetto </th>
            <th> nome_colore </th>
            <th> data_pubblicazione </th>
          </thead>
        </tr>
        <tbody>
          <tr>
            <td> <?php echo $row["IDprodotto"] ?> </td>
            <td> <?php echo $row["titolo"] ?> </td>
            <td> <?php echo $row["produttore"] ?> </td>
            <td> <?php echo $row["costo"] ?> </td>
            <td> <?php echo $row["nome_oggetto"] ?> </td>
            <td> <?php echo $row["nome_colore"] ?> </td>
            <td> <?php echo $row["data_pubblicazione"] ?> </td>
          </tr>
        <table>

        <br>

        <div class="insert-prodotto">

          <div class="container-filtri">
            <div class="CF01">
              <img src="<?php echo $imageURL; ?>" style="max-width:300px;">
            </div>
            <div class="CF02">
              <div class="CF02-c">
                cambia titolo <textarea name="insert-titolo" minlength="5" maxlength="50" rows="1" cols="60"></textarea>
                <button type="submit" name="cambio-titolo"> conferma cambio titolo </button>
                <br><br>

                cambia produttore
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
                <button type="submit" name="cambio-produttore"> conferma cambio produttore </button>
                <br><br>

                cambia costo <input type="number" name="insert-costo" step=".01">
                <button type="submit" name="cambio-costo"> conferma cambio costo </button>
                <br><br>

                cambia colore
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
                <button type="submit" name="cambio-colore"> conferma cambio colore </button>
              </div>
            </div>
          </div>

        </div>

        <br><hr><br>

        <div class="insert-prodotto">

          <table class="steelBlueCols">
            <tr>
              <thead>
                <th> taglia prodotto </th>
                <th> quantità </th>
                <th> modifica quantità </th>
                <th> # </th>
              </thead>
            </tr>
            <tbody>
          <?php
            while ($row2 = $result2->fetch_assoc()) {
              $sql_taglia = "SELECT * FROM taglia WHERE idtaglia = '{$row2["idtaglia"]}'";
                             $result_taglia = $conn->query($sql_taglia);
                             $row_taglia = $result_taglia->fetch_assoc();
          ?>
              <tr>
                <td> <?php echo $row_taglia["taglia"] ?> </td>
                <td> <?php echo $row2["quantita"] ?> </td>
                <td> <?php echo "<input type=number name=insert-quantita-{$row2["IDprodotto_taglia"]}>" ?> </td>
                <td> <?php echo "<button type=submit name=cambio-quantita value={$row2["IDprodotto_taglia"]}> conferma cambio quantità </button>" ?> </td>
              </tr>
            <?php
            }
            ?>
            </tbody>
          <table>

        </div>

    </form>

  </body>

</html>
