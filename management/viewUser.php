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
        <a href="./managementPage.php"> <button name="management-page"> Torna alla home </button> </a>
        <br><br>
        <a href="./aggiungiProdotto.php"> <button name="agg-prod"> Aggiungi prodotto </button> </a>
        <a href="./modificaProdotto.php"> <button name="mod-prod" style="margin: 0 10px;"> Modifica prodotto </button> </a>
        <a href="./viewUser.php"> <button name="view-user"> Utenti </button> </a>
        <br><br><hr><br>
      </div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <div class="filtri">
        <p> Cerca in base a: </p>
        <div class="container-filtri">
          <table class="tabella-filtri">
            <tr>
              <td>IDutente</td>
              <td><input type="number" name="cerca-idutente"></td>
              <td><button name="btn-cerca-idutente"> Cerca IDutente </button></td>
            </tr>
            <tr>
              <td>nome</td>
              <td><input type="text" name="cerca-nome"></td>
              <td><button name="btn-cerca-nome"> Cerca nome </button></td>
            </tr>
            <tr>
              <td>cognome</td>
              <td><input type="text" name="cerca-cognome"></td>
              <td><button name="btn-cerca-cognome"> Cerca cognome </button></td>
            </tr>
          </table>
          <table class="tabella-filtri">
            <tr>
              <td>email</td>
              <td><input type="text" name="cerca-email"></td>
              <td><button name="btn-cerca-email"> Cerca email </button></td>
            </tr>
            <tr>
              <td>username</td>
              <td><input type="text" name="cerca-username"></td>
              <td><button name="btn-cerca-username"> Cerca username </button></td>
            </tr>
            <tr>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </table>
          <button class="btn-resetF" name="resetta-filtri"> Resetta filtri </button>
        </div>
      </div>

      <br>

      <table class="steelBlueCols">
        <tr>
          <thead>
            <th> <button name="ordina-utenti-c" value="IDutente"> IDutente CRESC</button> </th>
            <th> <button name="ordina-utenti-c" value="nome"> nome CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="cognome"> cognome CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="email"> email CRESC</button></th>
            <th> <button name="ordina-utenti-c" value="username"> username CRESC</button></th>
            <th> </th>
          </thead>
          <thead>
            <th> <button name="ordina-utenti-d" value="IDutente"> IDutente DESC</button> </th>
            <th> <button name="ordina-utenti-d" value="nome"> nome DESC</button></th>
            <th> <button name="ordina-utenti-d" value="cognome"> cognome DESC</button></th>
            <th> <button name="ordina-utenti-d" value="email"> email DESC</button></th>
            <th> <button name="ordina-utenti-d" value="username"> username DESC</button></th>
            <th> <button name="resetta-filtri"> Resetta filtri </button> </th>
          </thead>
        </tr>

        <tbody>
          <?php

            if (!isset($_POST["ordina-utenti"]) || isset($_POST["resetta-filtri"])) {
              $sql = "SELECT * FROM utenti";
            }
            if (isset($_POST["ordina-utenti-c"])) {
              $str = $_POST["ordina-utenti-c"];
              $sql = "SELECT * FROM utenti ORDER BY $str";
            }
            if (isset($_POST["ordina-utenti-d"])) {
              $str = $_POST["ordina-utenti-d"];
              $sql = "SELECT * FROM utenti ORDER BY $str DESC";
            }

            if (isset($_POST["btn-cerca-idutente"])) {
              $idutente = $_POST["cerca-idutente"];
                $sql = "SELECT * FROM utenti WHERE idutente = '$idutente'";
            }
            if (isset($_POST["btn-cerca-nome"])) {
              $nome = $_POST["cerca-nome"];
                $sql = "SELECT * FROM utenti WHERE nome = '$nome'";
            }
            if (isset($_POST["btn-cerca-cognome"])) {
              $cognome = $_POST["cerca-cognome"];
                $sql = "SELECT * FROM utenti WHERE cognome = '$cognome'";
            }
            if (isset($_POST["btn-cerca-email"])) {
              $email = $_POST["cerca-email"];
                $sql = "SELECT * FROM utenti WHERE email = '$email'";
            }
            if (isset($_POST["btn-cerca-username"])) {
              $username = $_POST["cerca-username"];
                $sql = "SELECT * FROM utenti WHERE username = '$username'";
            }

          $result = $conn->query($sql);

          while($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td> <?php echo $row["IDutente"] ?> </td>
                <td> <?php echo $row["nome"] ?> </td>
                <td> <?php echo $row["cognome"] ?> </td>
                <td> <?php echo $row["email"] ?> </td>
                <td> <?php echo $row["username"] ?> </td>
                <td class="text-a">
                  <?php echo "<a href=./viewUser.select.php?IDutente={$row['IDutente']}>" ?>
                    seleziona
                  </a>
                </td>
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
