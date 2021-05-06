<?php
include './dbConfig/dbConfig.php';
?>
<!DOCTYPE html>
<html>


  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.mainpage.css">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="./css/style.tabellaProdotti.css">
    <link rel="stylesheet" href="./css/style.tipoAbito.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

    <div class="background"></div>

        <div class="header">
          <img src="./immagini/logo_small.png" class="logo" alt="logo" width="180px">
              <nav>
                <ul class="shortcut">
                  <li> <a href="./mainPage.php"> Home </a> </li>
                  <li> <a href="./contatti.php"> Contatti </a> </li>
                  <li> <a href="./log.php"> Carrello </a> </li>
                </ul>
              </nav>
              <a class="login" href="./log.php">
                <button class="button" name="button"> Login </button>
              </a>
        </div>

      <div class="entire-page">

        <div class="hero">

          <div class="img-home-header">
            <div class="container-img-home-header">
              <img src="./immagini/logo_small_icon.png" class="img-home">
            </div>
          </div>

          <div class="header2 sticky-header">
            <a href="./log.php" class="button2-a"> <button class="button2 nolog" name="button2-uomo"> Uomo </button> </a>
            <a href="./log.php" class="button2-a"> <button class="button2 nolog" name="button2-donna"> Donna </button> </a>
            <a href="./log.php" class="button2-a"> <button class="button2 nolog" name="button2-uomo"> Tutti i prodotti </button> </a>
            <a href="./log.php" class="button2-a"> <button class="button2 nolog" name="button2-donna"> Top 10 più venduti </button> </a>
          </div>

          <div class="about-us">
            <div class="c-about-us">
              <h1>CHI SIAMO?</h1>
              <div class="text-overlay-text">
                <p class="text-column">
                  Ciao! Siamo una nuova azienda e-commerce di abbigliamento e accessori,
                  e siamo i primi in Italia a offrire il servizio di consegna
                  a domicilio con drone <br>
                  Non dovrai fare altro che acquistare i nostri
                  prodotti e aspettare che il nostro drone volante
                  consegni autonomamente
                  il pacco all'indirizzo di consegna
                </p>
              </div>
            </div>
          </div>

          <div class="home-box">
            <h1> Ultimi arrivi </h1>
          </div>
          <!-- mettere alcuni dei prodotti piu recenti -->
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
                          LIMIT 5";

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
                          <a href=./log.php>
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
                                  <a href=./pageProdotto.php?IDprodotto={$row['IDprodotto']} class=btn-visualizza-prodotto-a-uomo> Visualizza prodotto </a>
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

          <div class="home-box margin-home-box">
            <div class="arrow-text">
              <h1> Per usufruire del nostro servizio è necessario che tu abbia un account </h1>
            </div>
            <div class="button-accedi-registra-mainP">
              <a href="./log.php"> <button style="margin-bottom: 20px;"> Accedi subito per usufruire del nostro servizio </button> </a>
              <br>
              <a href="./log.register.php"> <button> Non hai ancora un account? Registrati </button> </a>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="footer-content">
            <img src="./immagini/logo_small_icon.png" class="icon" width="45">
            <nav>
              <ul>
                <li> <p> Non sei connesso con nessun account </p> </li>
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

  </body

</html>
