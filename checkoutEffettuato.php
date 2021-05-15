<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: ./log.php");
}

include './dbConfig/dbConfig.php';
include './dbConfig/dbConfig_coupon.php';
?>
<!DOCTYPE html>
<html>

  <?php
    $str_errore = $_SESSION['str_errore'];
    $indirizzo_ck = $_SESSION['indirizzo_ck'];
    $citta_ck = $_SESSION['citta_ck'];
    $provincia_ck = $_SESSION['provincia_ck'];
    $cap_ck = $_SESSION['cap_ck'];
    $latitudine = $_SESSION['latitudine'];
    $longitudine = $_SESSION['longitudine'];
    $altitudine = $_SESSION['altitudine'];
  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.mainpage.css">
    <link rel="stylesheet" href="./css/style.tabellaProdotti.css">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="./css/style.pageProdotto.css">
    <link rel="stylesheet" href="./css/style.insertCarrello.css">
    <link rel="stylesheet" href="./css/style.checkout.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

    <div class="background"></div>
    <a id="back-to-top"></a>

      <div class="header">
          <img src="./immagini/logo_small.png" class="logo" alt="logo" width="180px">

            <nav>
              <ul class="shortcut">
                <li> <a href="./mainPageLogin.php"> Home </a> </li>
                <li> <a href="./contatti.php"> Contatti </a> </li>
                <li> <a href="./carrello.php"> Carrello </a> </li>
              </ul>
            </nav>

            <a href="./avatarInfo.php">
              <img src="./immagini/img_avatar.png" class="avatar" alt="logo" width="34.09px">
            </a>
      </div>

    <div class="entire-page">

      <div class="hero">

        <div class="header2 sticky-header">
          <a href="./mainPageUomo.php" class="button2-a"> <button class="button2 logged" name="button2-uomo"> Uomo </button> </a>
          <a href="./mainPageDonna.php" class="button2-a"> <button class="button2 logged" name="button2-donna"> Donna </button> </a>
          <a href="./mainPageTuttiP.php" class="button2-a"> <button class="button2 logged" name="button2-tuttiP"> Tutti i prodotti </button> </a>
          <a href="./mainPageTop10P.php" class="button2-a"> <button class="button2 logged" name="button2-Top10"> Top 10 prodotti più venduti </button> </a>
        </div>

        <div class="img-home-header-carrello">
          <div class="container-prodotto">
            <div class="container-nel-carrello">
              <div class="acquisto-effettuato">
                <?php
                  if ($str_errore == 'Acquisto andato a buon fine!') {
                    echo "<h1 class=aggiunto-true> $str_errore </h1>";
                    ?>
                      <h2> Il pacco verrà consegnato all'indirizzo <?php echo "$indirizzo_ck, $provincia_ck - $citta_ck (CAP: $cap_ck)" ?> </h2>
                      <p> Grazie per aver acquistato da noi! </p>
                      <a href="./cronologiaAcquisti.php"> <button type="button" name="button"> I miei acquisti </button> </a>
                    <?php
                  }
                  else {
                    echo "<h1 class=aggiunto-false> $str_errore </h1>";
                  }
                 ?>
              </div>
            </div>
          </div>
        </div>

          <div class="home-box">
            <h1> Ultimi arrivi </h1>
          </div>
          <div class="ultimi-arrivi">
              <ul class="prodotti-ul-home">
                <?php
                  $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                          ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                          INNER JOIN $produttore_prodotto
                          ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                          INNER JOIN $immagine_prodotto
                          ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                          ORDER BY data_pubblicazione DESC
                          LIMIT 10";

                  $result = $conn->query($sql);

                  while($row = $result->fetch_assoc()) {

                    $imageURL = 'uploads/'.$row["file_name"];
                    $IDoggetto = $row['idoggetto'];
                    $IDprodotto = $row['IDprodotto'];

                    $sql2 = "SELECT * FROM $taglia WHERE IDtaglia IN (
                             SELECT idtaglia FROM $prodotto_taglia WHERE idprodotto = $IDprodotto AND quantita > 0)";
                             $result2 = $conn->query($sql2);

                      $sql_calzatura = "SELECT * FROM $tipo_calzatura
                                        WHERE $tipo_calzatura.IDtipo_calzatura IN (
                                        SELECT idtipo_calzatura FROM $calzatura_oggetto WHERE IDcalzatura_oggetto IN (
                                        SELECT idcalzatura_oggetto FROM $oggetto WHERE IDoggetto = $IDoggetto
                                        ))";
                                        $result_calzatura = $conn->query($sql_calzatura);
                                        $row_calzatura = $result_calzatura->fetch_assoc();
                                        $sql_media_recensioni = "SELECT AVG(valutazione) as media_valutazione FROM $recensioni WHERE idprodotto = $IDprodotto";
                                        $result_media_recensioni = $conn->query($sql_media_recensioni);
                                        $row_media_recensioni = $result_media_recensioni->fetch_assoc();
                                        $media_recensioni = number_format($row_media_recensioni["media_valutazione"], 1);

                      echo "
                      <li class = prodotti-li title='{$row['titolo']}'>
                        <a href=./pageProdotto.php?IDprodotto={$row['IDprodotto']}>
                          <div class = container-prodotti>
                            <div class = img-prodotto>
                              <img src=$imageURL alt = product-image class = img-product>
                            </div>

                            <div class = overlay-prodotti>
                              <div class = over-img>
                              <button type = button name = valutation>
                                <img src=./immagini/star.png alt=stars style='filter: saturate(4);' width=16px> $media_recensioni
                              </button>
                            </div>
                              <div class=text-overlay-prodotti>
                                <label> Taglie disponibili </label>
                                <ul>
                                  ";
                                  while($row2 = $result2->fetch_assoc()) {
                                    echo "
                                    <li> <p> {$row2['taglia']} </p> </li>
                                    ";
                                  }
                                  echo "
                                </ul>
                                <br>
                                <label> Colore principale </label>
                                <ul class=colors>
                                  <li style = 'background: {$row['codice_colore']}'></li>
                                </ul>
                                <br>
                              </div>
                              <div class=btn-visualizza-prodotto>
                                <a href=./pageProdotto.php?IDprodotto={$row['IDprodotto']} class=btn-visualizza-prodotto-a> Visualizza prodotto </a>
                              </div>
                            </div>
                            <div class = bottom>
                              <div class=bottom-content>
                                <div class = bottom-title>
                                  <h2> {$row['produttore']} <span> ({$row_calzatura['tipo']}) </span> </h2>
                                  <span> €{$row['costo']} </span>
                                </div>
                                <p> {$row['titolo']} </p>
                              </div>
                            </div>
                          </div>
                        </a>
                      </li>";

                  }
            ?>
            </ul>
          </div>
        </div>

          <footer class="footer">
            <div class="footer-content">
              <img src="./immagini/logo_small_icon.png" class="icon" width="45">
                <nav>
                  <ul>
                    <li> <p> Sei connesso come </p> </li>
                    <li class="footer-email"> <a href="./avatarInfo.php"> <?php echo $_SESSION['email'] ?> </a> </li>
                    <li class="footer-esci">
                      <a href="./logout.php">
                        <button class="footer-button" name="footer-button"> Esci </button>
                      </a>
                    </li>
                  </ul>
                </nav>
              <img src="./immagini/logo_small_icon.png" class="icon2" width="45">
            </div>
          </footer>
          <div class="copyright">
            <p> Copyright &copy; 2021 Milanesi. All Rights Reserved </p>
          </div>

    </div>

    <button onclick="topFunction()" id="myBtn" title="Go to top"> </button>

    <script src="./js/main.js"></script>
    <script src="./js/pageProdotto.js"></script>

  </body

</html>
