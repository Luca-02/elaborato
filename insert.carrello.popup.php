<?php
  session_start();
  if(!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }
  include './dbConfig/dbConfig.php';
?>
<!DOCTYPE html>
<html>

  <?php

    $IDprodotto = $_SESSION['IDprodotto'];
    $quantita = $_SESSION['quantita'];
    $id_taglia = $_SESSION['id_taglia'];
    $errore = $_SESSION['errore'];

    $sql = "SELECT * FROM prodotto
            INNER JOIN $colore_prodotto
            ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
            INNER JOIN $produttore_prodotto
            ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
            INNER JOIN $immagine_prodotto
            ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
            INNER JOIN $oggetto
            ON $prodotto.idoggetto = $oggetto.IDoggetto
            WHERE IDprodotto = $IDprodotto";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $imageURL = 'uploads/'.$row["file_name"];

    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
                 $result_user = $conn->query($sql_user);
                 $row_user = $result_user->fetch_assoc();
                 $IDutente = $row_user["IDutente"];

    $sql_selectPT = "SELECT * FROM $prodotto_taglia WHERE idprodotto = $IDprodotto
                     AND idtaglia IN (
                     SELECT IDtaglia FROM $taglia WHERE IDtaglia = '$id_taglia'
                     )";
                     $result_selectPT = $conn->query($sql_selectPT);
                     $row_selectPT = $result_selectPT->fetch_assoc();
                     $IDprodotto_taglia = $row_selectPT["IDprodotto_taglia"];

    $sql_taglia = "SELECT * FROM $taglia WHERE IDtaglia = $id_taglia";
                   $result_taglia = $conn->query($sql_taglia);
                   $row_taglia = $result_taglia->fetch_assoc();

    $sql_sum_prodotti_carrello = "SELECT SUM(quantita_carrello) as sum_prodotti_carrello FROM $carrello
                                  WHERE idutente = $IDutente";
                                  $result_sum_prodotti_carrello = $conn->query($sql_sum_prodotti_carrello);
                                  $row_sum_prodotti_carrello = $result_sum_prodotti_carrello->fetch_assoc();
                                  $sum_prodotti_carrello = $row_sum_prodotti_carrello["sum_prodotti_carrello"];

    $prezzo_inserimento_prodotto = $row["costo"] * $quantita;
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
            <nav>
              <ul class="shortcut2">
                <li>
                  <div class="torna-indietro-prodotto" name="torna-indietro-infoprodotto">
                    <a href="javascript:history.go(-1)" onMouseOver="self.status=document.referrer;return true">
                      <i class="fa fa-arrow-left"></i> Torna indietro
                    </a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>

          <div class="img-home-header-carrello">
            <div class="container-prodotto">
              <div class="container-nel-carrello">
                <div class="nel-carrello">
                  <div class="img-nel-carrello">
                    <img src="<?php echo $imageURL; ?>">
                  </div>
                  <div class="agg-al-carrello">
                    <?php
                      if ($errore == 'Aggiunto al carrello') {
                        echo "<nobr class=aggiunto-true> $errore </nobr>";
                      }
                      else {
                        echo "<nobr class=aggiunto-false> $errore </nobr>";
                      }
                     ?>
                  </div>

                  <div class="prodotto-nel-carrello-info">
                    <div class="prodotto-nel-carrello-info-prodotto">
                      <h1> <?php echo $row['titolo'] ?> </h1>
                      <h2> Taglia: <?php echo $row_taglia["taglia"] ?> </h2>
                      <h3> Quantità: <?php echo $quantita ?> </h3>
                      <h4> Prezzo: €<?php echo $prezzo_inserimento_prodotto ?> </h4>
                    </div>
                    <div class="prodotto-nel-carrello-info-subt">
                      <b> Subtotale carrello
                        <span class="tot-articoli-carrello-nel-carrello">
                          (<?php
                            if ($sum_prodotti_carrello > 0) {
                              echo $sum_prodotti_carrello;
                            }
                            else {
                              echo "0";
                            }
                          ?>
                          articoli):
                        </span>
                        <span class="prezzo-tot-carrello-nel-carrello">
                          €<?php
                              $tot_carrello = 0;

                              $sql_costo_totC = "SELECT * FROM $carrello
                                                 INNER JOIN $prodotto_taglia ON
                                                 $carrello.idprodotto_taglia = $prodotto_taglia.IDprodotto_taglia
                                                 INNER JOIN prodotto ON
                                                 $prodotto_taglia.idprodotto = $prodotto.IDprodotto
                                                 WHERE $carrello.idutente = $IDutente";
                                                 $result_costo_totC = $conn->query($sql_costo_totC);

                              while ($row_costo_totC = $result_costo_totC->fetch_assoc()) {
                                $tot_carrello_parziale = $row_costo_totC["costo"] * $row_costo_totC["quantita_carrello"];
                                $tot_carrello = $tot_carrello + $tot_carrello_parziale;
                              }
                              echo "$tot_carrello";
                            ?>
                        </span>
                      </b>
                    </div>
                  </div>

                  <div class="btn-nel-carrello">
                    <a href="./carrello.php" class="go-to-carrello"> Carrello </a>
                  </div>
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
                          LIMIT 6";

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
