<!DOCTYPE html>
<html>

  <?php
    session_start();
    if (!isset($_SESSION['email'])) {
      header("Location: ./log.php");
    }

    include 'dbConfig.php';

    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
                 $result_user = $conn->query($sql_user);
                 $row_user = $result_user->fetch_assoc();
                 $IDutente = $row_user["IDutente"];

    $sql = "SELECT * FROM $carrello WHERE idutente = $IDutente";
            $result = $conn->query($sql);

    $sql_sum_prodotti_carrello = "SELECT SUM(quantita_carrello) as sum_prodotti_carrello FROM $carrello
                                  WHERE idutente = $IDutente";
                                  $result_sum_prodotti_carrello = $conn->query($sql_sum_prodotti_carrello);
                                  $row_sum_prodotti_carrello = $result_sum_prodotti_carrello->fetch_assoc();
                                  $sum_prodotti_carrello = $row_sum_prodotti_carrello["sum_prodotti_carrello"];

  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.carrello.css">
    <link rel="stylesheet" href="./css/style.mainpage.css">
    <link rel="stylesheet" href="./css/style.tabellaProdotti.css">
    <link rel="stylesheet" href="./css/style.tipoAbito.css">
    <link rel="stylesheet" href="./css/style.pageProdotto.css">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

      <div class="background"></div>

        <div class="header">
          <img src="./immagini/logo_small.png" class="logo" width="180px">
            <nav>
              <ul class="shortcut">
                <li> <a href="./mainPageLogin.php"> Home </a> </li>
                <li> <a href="./contatti.php"> Contatti </a> </li>
                <li> <a href="./carrello.php"> Carrello </a> </li>
              </ul>
            </nav>

            <a href="./avatarInfo.php">
              <img src="./immagini/img_avatar.png" class="avatar" alt="logo">
            </a>

        </div>

    <div class="entire-page">

      <div class="hero">

          <div class="header2 sticky-header">
            <a href="./mainPageUomo.php" class="button2-a"> <button class="button2 logged" name="button2-uomo"> Uomo </button> </a>
            <a href="./mainPageDonna.php" class="button2-a"> <button class="button2 logged" name="button2-donna"> Donna </button> </a>
            <a href="./mainPageTuttiP.php" class="button2-a"> <button class="button2 logged" name="button2-tuttiP"> Tutti i prodotti </button> </a>
            <a href="./mainPageTop10P.php" class="button2-a"> <button class="button2 logged" name="button2-Top10"> Top 10 più venduti </button> </a>
          </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

          <div class="prodotti">
            <div class="container-carrello">

              <div class="header-carrello">
                <h1> Il Tuo Carrello </h1>
              </div>

              <div class="prodotti-carrello">
                <ul>
                  <?php

                    $sql_cont = "SELECT count(*) as cont_prodotti_carrello FROM $carrello WHERE idutente = $IDutente";
                                 $result_cont = $conn->query($sql_cont);
                                 $row_cont = $result_cont->fetch_assoc();

                    if ($row_cont["cont_prodotti_carrello"] > 0) {

                      while ($row = $result->fetch_assoc()) {
                      $IDprodotto_taglia = $row['idprodotto_taglia'];

                      $sql2 = "SELECT * FROM $prodotto_taglia
                               INNER JOIN $prodotto
                               ON $prodotto_taglia.idprodotto = $prodotto.IDprodotto
                               INNER JOIN $colore_prodotto
                               ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                               INNER JOIN $produttore_prodotto
                               ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                               INNER JOIN $immagine_prodotto
                               ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                               WHERE IDprodotto_taglia = $IDprodotto_taglia";
                               $result2 = $conn->query($sql2);
                               $row2 = $result2->fetch_assoc();
                               $imageURL = 'uploads/'.$row2["file_name"];

                      $sql3 = "SELECT * FROM $taglia WHERE IDtaglia IN (
                               SELECT idtaglia FROM $prodotto_taglia WHERE IDprodotto_taglia = $IDprodotto_taglia
                               )";
                               $result3 = $conn->query($sql3);
                               $row3 = $result3->fetch_assoc();

                      $sql_qta = "SELECT * FROM $carrello WHERE idprodotto_taglia = $IDprodotto_taglia AND idutente = $IDutente";
                                  $result_qta = $conn->query($sql_qta);
                                  $row_qta = $result_qta->fetch_assoc();
                                  $quantita_carrello_prod = $row_qta["quantita_carrello"];

                    ?>

                      <li>
                        <div class="prodotto-carrello-container">
                          <img src="<?php echo $imageURL; ?>">

                          <div class="info-prodotto-carrello">
                            <div class="text-prezzo-carrello">
                              <p> €<?php echo $row2["costo"] * $row_qta["quantita_carrello"] ?> </p>
                            </div>
                            <h1> <?php echo $row2["produttore"] ?> </h1>
                            <h2> <?php echo $row2["titolo"] ?> </h2>

                            <div class="colore-prodotto-carrello">
                              <p style="font-size: 16px;"> Colore principale: <input type="text" readonly style = "background: <?php echo "{$row2["codice_colore"]}" ?> ;"> </input></p>
                            </div>
                            <p style="font-size: 16px;"> Taglia: <?php echo $row3["taglia"] ?></p>
                            <h3> Prezzo singolo: €<?php echo $row2["costo"] ?> </h3>

                            <div class="btn-quantita-rimuovi">
                              Quantità:
                                <input type="number" name="quantita_carrello" min="1" max="10" value="<?php echo $quantita_carrello_prod ?>" title="Quantità" readonly>
                              <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i>
                                <button type="submit" name="btn-rimuovi-carrello" class="btn-rimuovi" value="<?php echo $IDprodotto_taglia ?>"> Rimuovi dal carrello </button>
                                <?php
                                if (isset($_POST["btn-rimuovi-carrello"])) {
                                  $IDprodotto_taglia = $_POST["btn-rimuovi-carrello"];

                                  $sql_delete = "DELETE FROM $carrello WHERE idprodotto_taglia = $IDprodotto_taglia AND idutente = $IDutente";

                                  if ($conn->query($sql_delete) === TRUE) {
                                    header("Location: " . $_SERVER['PHP_SELF']);
                                  }
                                  else {
                                    echo "Error deleting record: " . $conn->error;
                                  }
                                }
                                ?>
                            </div>
                          </div>
                        </div>
                      </li>

                    <?php
                      }
                    }
                    else {
                    ?>
                      <div class="empty-cart">
                        <p> Non ci sono prodotti nel carrello </p>
                      </div>
                    <?php
                    }
                   ?>
                </ul>
              </div>

            </form>

            <form action="./checkout.php" method="post">

              <div class="footer-carrello">
                <h2> Totale provvisorio
                  <span class="tot-articoli-carrello-carrello">
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
                </h2>
                <?php
                  if ($row_cont["cont_prodotti_carrello"] > 0) {
                    ?>
                      <button type="submit" name="procedi-ordine"> Procedi all'ordine </button>
                    <?php
                  }
                  else
                 ?>
              </div>

            </form>

            </div>
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

  </body

</html>
