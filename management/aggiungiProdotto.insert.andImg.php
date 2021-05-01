<!DOCTYPE html>
<html>

  <?php
    session_start();
    // if (!isset($_SESSION['email'])) {
    //   header("Location: ./log.php");
    // }

    include '../dbConfig/dbConfig.php';

    $idoggetto = $_SESSION['idoggetto'];
    $titolo = $_SESSION['titolo'];
    $produttore = $_SESSION['produttore'];
    $costo = $_SESSION['costo'];
    $colore = $_SESSION['colore'];
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

        <?php
        if (isset($_POST["submit-prodotto-taglia"]))
        {
          $sql_insertP = "INSERT INTO prodotto (titolo, idproduttore_prodotto, costo, idoggetto, idcolore_prodotto, data_pubblicazione)
                          VALUES ('$titolo', '$produttore', '$costo', '$idoggetto', '$colore', NOW())";

          if ($conn->query($sql_insertP))
          {
            $sql_idprodotto = "SELECT * FROM prodotto WHERE titolo = '$titolo'";
                               $result_idprodotto = $conn->query($sql_idprodotto);
                               $row_idprodotto = $result_idprodotto->fetch_assoc();
                               $idprodotto = $row_idprodotto["IDprodotto"];

            $sql_taglia = "SELECT * FROM taglia WHERE idtipo_oggetto IN (
                           SELECT IDtipo_oggetto FROM tipo_oggetto WHERE IDtipo_oggetto IN(
                           SELECT idtipo_oggetto FROM calzatura_oggetto WHERE IDcalzatura_oggetto IN (
                           SELECT idcalzatura_oggetto FROM oggetto WHERE IDoggetto = $idoggetto )))
                           ORDER BY IDtaglia";
                           $result_taglia = $conn->query($sql_taglia);

            while ($row_taglia = $result_taglia->fetch_assoc())
            {
              $idtaglia = $row_taglia["IDtaglia"];
              $quantita = $_POST["quantita-$idtaglia"];
              $sql_insertPT = "INSERT INTO prodotto_taglia (quantita, idtaglia, idprodotto) VALUES ('$quantita', '$idtaglia', '$idprodotto')";

              if ($conn->query($sql_insertPT))
              {
              }
              else
              {
                echo "<p class=errore> Errore nell'inserimento while, riprovare: <br>" . $conn->error . "</p>";
              }
            }
            session_start();
            $_SESSION['idprodotto'] = $idprodotto;
            header("Location: ./aggiungiProdotto.insertImg.php");
          }
          else
          {
            echo "<p class=errore> Errore nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
          }
        }
        ?>

      </div>
    </form>

  </body

</html>
