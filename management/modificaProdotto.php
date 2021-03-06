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
  $sql_dip = "SELECT * FROM dipendenti
              INNER JOIN mansioni ON
              $dipendenti.idmansione = $mansioni.IDmansione
              WHERE email_aziendale = '$email_aziendale'";
              $result_dip = $conn2->query($sql_dip);
              $row_dip = $result_dip->fetch_assoc();
              $iddipendente = $row_dip["IDdipendente"];
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

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

      <div class="filtri">
        <p> Cerca in base a: </p>
        <div class="container-filtri">
          <table class="tabella-filtri">
            <tr>
              <td>IDprodotto</td>
              <td><input type="number" name="cerca-idprodotto"></td>
              <td><button name="btn-cerca-idprodotto"> Cerca IDprodotto </button></td>
            </tr>
            <tr>
              <td>titolo</td>
              <td><input type="text" name="cerca-titolo"></td>
              <td><button name="btn-cerca-titolo"> Cerca titolo </button></td>
            </tr>
            <tr>
              <td>produttore</td>
              <td>
                <select name="cerca-produttore">
                  <option value="" selected disabled> Seleziona produttore </option>
                  <?php
                  $sql_produttori = "SELECT DISTINCT $produttore_prodotto.IDproduttore_prodotto, produttore
                  FROM $prodotto INNER JOIN $produttore_prodotto
                  ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                  ORDER BY produttore";
                  $result_produttori = $conn->query($sql_produttori);

                  while($row_produttori = $result_produttori->fetch_assoc()) {
                    echo "<option value={$row_produttori['IDproduttore_prodotto']}> {$row_produttori['produttore']} </option>";
                  }
                  ?>
                </select>
              </td>
              <td><button name="btn-cerca-produttore"> Cerca produttore </button></td>
            </tr>
            <tr>
              <td>data_pubblicazione</td>
              <td><input type="date" name="cerca-data_pubblicazione"></td>
              <td><button name="btn-cerca-data_pubblicazione"> Cerca data_pubblicazione </button></td>
            </tr>
          </table>
          <table class="tabella-filtri">
            <tr>
              <td>max costo</td>
              <td><input type="number" name="cerca-costoMax"></td>
              <td><button name="btn-cerca-costoMax"> Cerca costo </button></td>
            </tr>
            <tr>
              <td>min costo</td>
              <td><input type="number" name="cerca-costoMin"></td>
              <td><button name="btn-cerca-costoMin"> Cerca costo </button></td>
            </tr>
            <tr>
              <td>nome_oggetto</td>
              <td><input type="text" name="cerca-nome_oggetto"></td>
              <td><button name="btn-cerca-data_pubblicazione"> Cerca data_pubblicazione </button></td>
            </tr>
            <tr>
              <td>tipo_calzatura</td>
              <td>
                <select name="cerca-tipo_calzatura">
                  <option value="" selected disabled> Seleziona tipo_calzatura </option>
                  <option value="1"> uomo </option>
                  <option value="2"> donna </option>
                </select>
              </td>
              <td><button name="btn-cerca-tipo_calzatura"> Cerca tipo_calzatura </button></td>
            </tr>
          </table>
          <button class="btn-resetF" name="resetta-filtri"> Resetta filtri </button>
        </div>
      </div>

      <br>

      <table class="steelBlueCols">
        <tr>
          <thead>
            <th> <button name="ordina-prodotti-c" value="IDprodotto"> IDprodotto CRESC</button> </th>
            <th> <button name="ordina-prodotti-c" value="titolo"> titolo CRESC</button></th>
            <th> <button name="ordina-prodotti-c" value="produttore"> produttore CRESC</button></th>
            <th> <button name="ordina-prodotti-c" value="costo"> costo CRESC</button></th>
            <th> <button name="ordina-prodotti-c" value="nome_oggetto"> nome_oggetto CRESC</button></th>
            <th> <button name="ordina-prodotti-c" value="nome_colore"> nome_colore CRESC</button></th>
            <th> <button name="ordina-prodotti-c" value="data_pubblicazione"> data_pubblicazione CRESC</button></th>
            <th> </th>
            <th> </th>
          </thead>
          <thead>
            <th> <button name="ordina-prodotti-d" value="IDprodotto"> IDprodotto DESC</button> </th>
            <th> <button name="ordina-prodotti-d" value="titolo"> titolo DESC</button></th>
            <th> <button name="ordina-prodotti-d" value="produttore"> produttore DESC</button></th>
            <th> <button name="ordina-prodotti-d" value="costo"> costo DESC</button></th>
            <th> <button name="ordina-prodotti-d" value="nome_oggetto"> nome_oggetto DESC</button></th>
            <th> <button name="ordina-prodotti-d" value="nome_colore"> nome_colore DESC</button></th>
            <th> <button name="ordina-prodotti-d" value="data_pubblicazione"> data_pubblicazione DESC</button></th>
            <th> Tipo calzatura </th>
            <th> <button name="resetta-filtri"> Resetta filtri </button> </th>
          </thead>
        </tr>

        <tbody>
          <?php

            if (!isset($_POST["ordina-prodotti-c"]) || !isset($_POST["ordina-prodotti-c"]) || isset($_POST["resetta-filtri"])) {
              $sql = "SELECT * FROM prodotto
              INNER JOIN oggetto
              ON $prodotto.idoggetto = $oggetto.idoggetto
              INNER JOIN colore_prodotto
              ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
              INNER JOIN produttore_prodotto
              ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
              ORDER BY IDprodotto";
            }
            if (isset($_POST["ordina-prodotti-c"])) {
              $str = $_POST["ordina-prodotti-c"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                ORDER BY $str";
            }
            if (isset($_POST["ordina-prodotti-d"])) {
              $str = $_POST["ordina-prodotti-d"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                ORDER BY $str DESC";
            }

            if (isset($_POST["btn-cerca-idprodotto"])) {
              $idprodotto = $_POST["cerca-idprodotto"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE IDprodotto = $idprodotto
                ORDER BY IDprodotto";
            }
            if (isset($_POST["btn-cerca-titolo"])) {
              $titolo = $_POST["cerca-titolo"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE titolo LIKE '%$titolo%'
                ORDER BY IDprodotto";
            }
            if (isset($_POST["btn-cerca-produttore"])) {
              $idproduttore = $_POST["cerca-produttore"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE $produttore_prodotto.IDproduttore_prodotto = '$idproduttore'
                ORDER BY IDprodotto";
            }
            if (isset($_POST["btn-cerca-costoMin"])) {
              $costo = $_POST["cerca-costoMin"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE costo >= '$costo'
                ORDER BY IDprodotto";
            }
            if (isset($_POST["btn-cerca-costoMax"])) {
              $costo = $_POST["cerca-costoMax"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE costo <= '$costo'
                ORDER BY IDprodotto";
            }
            if (isset($_POST["btn-cerca-nome_oggetto"])) {
              $nome_oggetto = $_POST["cerca-nome_oggetto"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE nome_oggetto LIKE '%$nome_oggetto%'
                ORDER BY IDprodotto";
            }
            if (isset($_POST["btn-cerca-data_pubblicazione"])) {
              $data_pubblicazione = $_POST["cerca-data_pubblicazione"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE data_pubblicazione LIKE '%$data_pubblicazione%'
                ORDER BY IDprodotto";
            }
            if (isset($_POST["btn-cerca-tipo_calzatura"])) {
              $idtipo_calzatura = $_POST["cerca-tipo_calzatura"];
                $sql = "SELECT * FROM prodotto
                INNER JOIN oggetto
                ON $prodotto.idoggetto = $oggetto.idoggetto
                INNER JOIN colore_prodotto
                ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                INNER JOIN produttore_prodotto
                ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                WHERE idcalzatura_oggetto IN (
                SELECT IDcalzatura_oggetto FROM $calzatura_oggetto WHERE idtipo_calzatura = '$idtipo_calzatura'
                )
                ORDER BY IDprodotto";
            }

          $result = $conn->query($sql);

          while($row = $result->fetch_assoc()) {

            $IDoggetto = $row['idoggetto'];
            $sql_calzatura = "SELECT * FROM tipo_calzatura
                              WHERE $tipo_calzatura.IDtipo_calzatura IN (
                              SELECT idtipo_calzatura FROM $calzatura_oggetto WHERE IDcalzatura_oggetto IN (
                              SELECT idcalzatura_oggetto FROM $oggetto WHERE IDoggetto = $IDoggetto
                              ))";
                              $result_calzatura = $conn->query($sql_calzatura);
                              $row_calzatura = $result_calzatura->fetch_assoc();

            ?>
                <tr>
                  <td> <?php echo $row["IDprodotto"] ?> </td>
                  <td> <?php echo $row["titolo"] ?> </td>
                  <td> <?php echo $row["produttore"] ?> </td>
                  <td> <?php echo $row["costo"] ?> </td>
                  <td> <?php echo $row["nome_oggetto"] ?> </td>
                  <td> <?php echo $row["nome_colore"] ?> </td>
                  <td> <?php echo $row["data_pubblicazione"] ?> </td>
                  <td> <?php echo $row_calzatura["tipo"] ?> </td>
                  <td class="text-a">
                    <?php echo "<a href=./update.modificaProdotto.php?IDprodotto={$row['IDprodotto']}>" ?>
                      modifica
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
