<?php
session_start();
if (!isset($_SESSION['email'])) {
  header("Location: ./log.php");
}

include './dbConfig/dbConfig.php';
?>
<!DOCTYPE html>
<html>

  <?php

    $IDprodotto = $_GET['IDprodotto'];

    $sql = "SELECT * FROM prodotto
            INNER JOIN $colore_prodotto
            ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
            INNER JOIN $produttore_prodotto
            ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
            WHERE IDprodotto = $IDprodotto";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

    $sql_recensioni = "SELECT * FROM $recensioni WHERE idprodotto = $IDprodotto ";
                      $result_recensioni = $conn->query($sql_recensioni);

    $sql_media_recensioni = "SELECT AVG(valutazione) as media_valutazione FROM $recensioni WHERE idprodotto = $IDprodotto";
                             $result_media_recensioni = $conn->query($sql_media_recensioni);
                             $row_media_recensioni = $result_media_recensioni->fetch_assoc();
                             $media_recensioni = number_format($row_media_recensioni["media_valutazione"], 1);

    $sql_cont_recensioni = "SELECT COUNT(*) as cont_recensioni_tot FROM $recensioni WHERE idprodotto = $IDprodotto";
                            $result_cont_recensioni = $conn->query($sql_cont_recensioni);
                            $row_cont_recensioni = $result_cont_recensioni->fetch_assoc();

    $sql_cont_recensioni_5 = "SELECT idprodotto, valutazione, count(*) as cont_recensioni
                              FROM $recensioni WHERE idprodotto = $IDprodotto AND valutazione = 5";
                              $result_cont_recensioni_5 = $conn->query($sql_cont_recensioni_5);
                              $row_cont_recensioni_5 = $result_cont_recensioni_5->fetch_assoc();

    $sql_cont_recensioni_4 = "SELECT idprodotto, valutazione, count(*) as cont_recensioni
                              FROM $recensioni WHERE idprodotto = $IDprodotto AND valutazione = 4";
                              $result_cont_recensioni_4 = $conn->query($sql_cont_recensioni_4);
                              $row_cont_recensioni_4 = $result_cont_recensioni_4->fetch_assoc();

    $sql_cont_recensioni_3 = "SELECT idprodotto, valutazione, count(*) as cont_recensioni
                              FROM $recensioni WHERE idprodotto = $IDprodotto AND valutazione = 3";
                              $result_cont_recensioni_3 = $conn->query($sql_cont_recensioni_3);
                              $row_cont_recensioni_3 = $result_cont_recensioni_3->fetch_assoc();

    $sql_cont_recensioni_2 = "SELECT idprodotto, valutazione, count(*) as cont_recensioni
                              FROM $recensioni WHERE idprodotto = $IDprodotto AND valutazione = 2";
                              $result_cont_recensioni_2 = $conn->query($sql_cont_recensioni_2);
                              $row_cont_recensioni_2 = $result_cont_recensioni_2->fetch_assoc();

    $sql_cont_recensioni_1 = "SELECT idprodotto, valutazione, count(*) as cont_recensioni
                              FROM $recensioni WHERE idprodotto = $IDprodotto AND valutazione = 1";
                              $result_cont_recensioni_1 = $conn->query($sql_cont_recensioni_1);
                              $row_cont_recensioni_1 = $result_cont_recensioni_1->fetch_assoc();
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
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

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

          <div class="container-prodotto page-recensioni">

              <div class="info-prodotto-recensioni">
                <h1> <?php echo $row["titolo"] ?> </h1>
                <p class="text-valutazione"> <img src="./immagini/star.png" style="filter: saturate(4);width: 23px;"> <?php echo $media_recensioni ?> </p>
              </div>

            <div class="container-stima-recensioni">
              <div class="stima-recensioni">

                <div class="scrivi-recensione">
                  <?php echo "<a href=./scriviRecensione.php?IDprodotto={$IDprodotto} name=scrivi_recensione title=Scrivi una recensione>"; ?>
                    Scrivi una recensione
                  </a>
                </div>

                <div class="header-stima-recensioni">
                  <h1> Recensioni clienti </h1>
                  <h3>
                    <?php
                      if ($row_cont_recensioni["cont_recensioni_tot"] > 0) {
                        echo "$media_recensioni stelle di media su un totale di {$row_cont_recensioni["cont_recensioni_tot"]} recensioni";
                      } else {
                        echo "Non ci sono recensioni di questo prodotto";
                      }
                    ?>
                  </h3>
                </div>

                <div class="row">

                   <div class="side">
                     <div> 5 <img src="./immagini/star.png" style="filter: saturate(4);"></div>
                   </div>
                   <div class="middle">
                     <?php
                        if ($row_cont_recensioni_5["cont_recensioni"] > 0) {
                          $percentuale = ($row_cont_recensioni_5["cont_recensioni"]/$row_cont_recensioni["cont_recensioni_tot"])*100;
                          echo "
                          <div class=bar-container>
                          <div class=bar style = 'width: $percentuale%;'></div>
                          </div>";
                        } else {
                          echo "
                          <div class=bar-container>
                          <div class=bar style = 'width: 0%;'></div>
                          </div>";
                        }
                      ?>
                   </div>
                       <div class="side right">
                         <div> <?php echo $row_cont_recensioni_5["cont_recensioni"] ?> </div>
                       </div>

                  <div class="side">
                    <div>4 <img src="./immagini/star.png" style="filter: saturate(4);"></div>
                  </div>
                  <div class="middle">
                    <?php
                       if ($row_cont_recensioni_4["cont_recensioni"] > 0) {
                         $percentuale = ($row_cont_recensioni_4["cont_recensioni"]/$row_cont_recensioni["cont_recensioni_tot"])*100;
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: $percentuale%;'></div>
                         </div>";
                       } else {
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: 0%;'></div>
                         </div>";
                       }
                     ?>
                  </div>
                      <div class="side right">
                        <div> <?php echo $row_cont_recensioni_4["cont_recensioni"] ?> </div>
                      </div>

                  <div class="side">
                    <div>3 <img src="./immagini/star.png" style="filter: saturate(4);"></div>
                  </div>
                  <div class="middle">
                    <?php
                       if ($row_cont_recensioni_3["cont_recensioni"] > 0) {
                         $percentuale = ($row_cont_recensioni_3["cont_recensioni"]/$row_cont_recensioni["cont_recensioni_tot"])*100;
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: $percentuale%;'></div>
                         </div>";
                       } else {
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: 0%;'></div>
                         </div>";
                       }
                     ?>
                  </div>
                      <div class="side right">
                        <div> <?php echo $row_cont_recensioni_3["cont_recensioni"] ?> </div>
                      </div>

                  <div class="side">
                    <div>2 <img src="./immagini/star.png" style="filter: saturate(4);"></div>
                  </div>
                  <div class="middle">
                    <?php
                       if ($row_cont_recensioni_2["cont_recensioni"] > 0) {
                         $percentuale = ($row_cont_recensioni_2["cont_recensioni"]/$row_cont_recensioni["cont_recensioni_tot"])*100;
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: $percentuale%;'></div>
                         </div>";
                       } else {
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: 0%;'></div>
                         </div>";
                       }
                     ?>
                  </div>
                      <div class="side right">
                        <div> <?php echo $row_cont_recensioni_2["cont_recensioni"] ?> </div>
                      </div>

                  <div class="side">
                    <div>1 <img src="./immagini/star.png" style="filter: saturate(4);"></div>
                  </div>
                  <div class="middle">
                    <?php
                       if ($row_cont_recensioni_1["cont_recensioni"] > 0) {
                         $percentuale = ($row_cont_recensioni_1["cont_recensioni"]/$row_cont_recensioni["cont_recensioni_tot"])*100;
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: $percentuale%;'></div>
                         </div>";
                       } else {
                         echo "
                         <div class=bar-container>
                         <div class=bar style = 'width: 0%;'></div>
                         </div>";
                       }
                     ?>
                  </div>
                      <div class="side right">
                        <div> <?php echo $row_cont_recensioni_1["cont_recensioni"] ?> </div>
                      </div>

                </div>

              </div>
            </div>

            <div class="container-recensioni">
                <?php
                    $sql_cont = "SELECT COUNT(*) as cont_recensioni FROM $recensioni WHERE idprodotto = $IDprodotto";
                                            $result_cont = $conn->query($sql_cont);
                                            $row_cont = $result_cont->fetch_assoc();

                    echo "<div class=header-recensioni>
                            <h1> Tutte le recensioni ({$row_cont['cont_recensioni']}) </h1>
                          </div>
                          <ul>";

                    //cont che servirà per contare le recensioni fino ad un massimo di 5
                    $cont = 0;

                    while (($row_recensioni = $result_recensioni->fetch_assoc()) && ($cont < 5)) {
                      $IDutente = $row_recensioni["idutente"];
                      $sql_utente_recensione = "SELECT * FROM $utenti WHERE IDutente = '$IDutente'";
                      $result_utente_recensione = $conn->query($sql_utente_recensione);
                      $row_utente_recensione = $result_utente_recensione->fetch_assoc();
                ?>
                  <li>
                    <div class="collapsible" title="Recensione di Username">
                      <div class="collapsible-text">
                        <p> <?php echo $row_utente_recensione["username"] ?> -
                          <span> <?php echo $row_recensioni["titolo_recensione"] ?> - <img src="./immagini/star.png" style="filter: saturate(4);"> <?php echo $row_recensioni["valutazione"] ?> </span>
                        </p>
                      </div>
                    </div>
                    <div class="content-recensione">
                      <div class="text-recensione">
                        <h3> <?php echo $row_recensioni["data_recensione"] ?> </h3>
                        <p> <?php echo $row_recensioni["testo_recensione"] ?> </p>
                      </div>
                    </div>
                  </li>
                <?php
                      $cont++;
                    }
                    echo "</ul>";
                ?>

            </div>

          </div>

        </form>
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
