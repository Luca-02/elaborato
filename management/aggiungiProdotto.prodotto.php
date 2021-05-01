<!DOCTYPE html>
<html>

  <?php
    session_start();
    // if (!isset($_SESSION['email'])) {
    //   header("Location: ./log.php");
    // }

    include '../dbConfig/dbConfig.php';

    $idoggetto = $_SESSION['idoggetto'];

    $sql_oggetto = "SELECT * FROM oggetto WHERE IDoggetto = '$idoggetto'";
                    $result_oggetto = $conn->query($sql_oggetto);
                    $row_oggetto = $result_oggetto->fetch_assoc();
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
        <h1> <?php echo $row_oggetto["nome_oggetto"] ?> </h1>

        <table class="table-insert1">
          <tr>
            <td>titolo</td>
            <td><textarea name="insert-titolo" minlength="5" maxlength="50" rows="1" cols="60" required></textarea></td>
            <td></td>
          </tr>
          <tr>
            <td>produttore</td>
            <td>
              <select name="insert-produttore" required>
                <option value="" selected disabled> Seleziona produttore </option>
                <?php
                  $sql_produttore = "SELECT * FROM produttore_prodotto ORDER BY produttore";
                                     $result_produttore = $conn->query($sql_produttore);

                  while ($row_produttore = $result_produttore->fetch_assoc()) {
                    echo "<option class=option-style value={$row_produttore["IDproduttore_prodotto"]}> {$row_produttore["produttore"]} </option>";
                  }
                ?>
              </select>
            </td>
            <td> <a href="./aggiungiProduttore.php"> <button type="button" name="button"> aggiungi nuovo produttore </button> </a> </td>
          </tr>
          <tr>
            <td>costo</td>
            <td><input type="number" name="insert-costo" step=".01" required></td>
            <td></td>
          </tr>
          <tr>
            <td>colore</td>
            <td>
              <select name="insert-colore" required>
                <option value="" selected disabled> Seleziona colore </option>
                <?php
                  $sql_colore = "SELECT * FROM colore_prodotto ORDER BY nome_colore";
                                 $result_colore = $conn->query($sql_colore);

                  while ($row_colore = $result_colore->fetch_assoc()) {
                    echo "<option class=option-style value={$row_colore["IDcolore_prodotto"]}> {$row_colore["nome_colore"]} - {$row_colore["codice_colore"]} </option>";
                  }
                ?>
              </select>
            </td>
            <td> <a href="./aggiungiColore.php"> <button type="button" name="button"> aggiungi nuovo colore </button> </a> </td>
          </tr>
        </table>

        <br>

        <button name="submit-prodotto"> Conferma </button>
        <button name="ripristina-campi"> Ripristina campi </button>

        <?php
          if (isset($_POST["ripristina-campi"])) {
            header("Location: " . $_SERVER['PHP_SELF'] );
          }

          if (isset($_POST["submit-prodotto"])) {
            $titolo = strtolower($_POST["insert-titolo"]);
            $produttore = $_POST["insert-produttore"];
            $costo = $_POST["insert-costo"];
            $colore = $_POST["insert-colore"];

            // session_start();
            $_SESSION['idoggetto'] = $idoggetto;
            $_SESSION['titolo'] = $titolo;
            $_SESSION['produttore'] = $produttore;
            $_SESSION['costo'] = $costo;
            $_SESSION['colore'] = $colore;
            header("Location: ./aggiungiProdotto.insert.andImg.php");
          }
        ?>

      </div>

    </form>

  </body

</html>
