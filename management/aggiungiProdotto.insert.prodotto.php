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
    $idoggetto = $_SESSION['idoggetto'];
    $titolo = $_SESSION['titolo'];
    $produttore = $_SESSION['produttore'];
    $costo = $_SESSION['costo'];
    $colore = $_SESSION['colore'];

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

  <body>

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


    <form action="./aggiungiProdotto.insert.prodotto_taglia.php" method="post">

      <div class="insert-prodotto">

        idoggetto: <?php echo "$idoggetto"; ?> <br><br>
        titolo: <?php echo "$titolo"; ?> <br><br>
        idproduttore <?php echo "$produttore"; ?> <br><br>
        costo: <?php echo "$costo"; ?> <br><br>
        idcolore: <?php echo "$colore"; ?> <br><br>

        <div class="insert-taglia-container">
          <div class="taglia-container1">
            <table class="table-insert2">
              <tr>
                <th> taglia </th>
                <th> quantità </th>
              </tr>
              <?php
                $sql_taglia = "SELECT * FROM taglia WHERE idtipo_oggetto IN (
                               SELECT IDtipo_oggetto FROM tipo_oggetto WHERE IDtipo_oggetto IN(
                               SELECT idtipo_oggetto FROM calzatura_oggetto WHERE IDcalzatura_oggetto IN (
                               SELECT idcalzatura_oggetto FROM oggetto WHERE IDoggetto = $idoggetto )))
                               ORDER BY IDtaglia";
                $result_taglia = $conn->query($sql_taglia);

                while ($row_taglia = $result_taglia->fetch_assoc()) {
                  ?>
                    <tr>
                      <td> <?php echo $row_taglia["taglia"] ?> </td>
                      <td> <input type="number" name="<?php echo "quantita-{$row_taglia["IDtaglia"]}" ?>" value="0"> </td>
                    </tr>
                  <?php
                }
              ?>
            </table>
            <br>
          </div>
          <div class="taglia-container2">
            <button name="submit-prodotto-taglia"> Inserisci tutto </button>
          </div>
        </div>

      </div>

    </form>

  </body>

</html>
