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

    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
                 $result_user = $conn->query($sql_user);
                 $row_user = $result_user->fetch_assoc();
                 $IDutente = $row_user["IDutente"];

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
    <link rel="stylesheet" href="./css/style.pageProdotto.css">
    <link rel="stylesheet" href="./css/style.acquisti.css">
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
            <a href="./mainPageTop10P.php" class="button2-a"> <button class="button2 logged" name="button2-Top10"> Top 10 prodotti più venduti </button> </a>
          </div>

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                    <?php
                      $sql_cont = "SELECT count(*) as cont_prodotti_acquistati FROM acquisto WHERE idordine IN (SELECT IDordine FROM ordine WHERE idutente = $IDutente)";
                                   $result_cont = $conn->query($sql_cont);
                                   $row_cont = $result_cont->fetch_assoc();

                      if ($row_cont["cont_prodotti_acquistati"] == 0) {
                        ?>
                        <div class="img-home-header-carrello">
                          <div class="prodotti">
                              <div class="container-acquisti">
                                <div class="div-acquisti">

                                  <div class="empty-cart">
                                    <p> Non hai acquistato nessun nostro prodotto </p>
                                    <a href="./mainPageTuttiP.php"> <button type="button" class="btn-noprodottiA" name="button"> Inizia subito ad acquistare da noi </button> </a>
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
                                          LIMIT 12";

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
                        <?php
                      }
                      else {
                        ?>
                        <div class="prodotti">

                          <div class="container-option">
                              <div class="container-option-ordina-opzioni center-item">

                                <details>
                                  <summary> Anno </summary>
                                  <ul>
                                    <?php
                                      $now = new DateTime();
                                      $year_now = $now->format('Y');

                                      $a = 0;
                                      while ($a<5) {
                                        echo "<li> <button name=1anno-acquisto value=$year_now> $year_now </button> </li>";
                                        $year_now--;
                                        $a++;
                                      }
                                     ?>
                                  </ul>
                                </details>

                                <details>
                                  <summary> Anno e mese </summary>
                                  <ul>
                                      <div class="anno-mese-container">
                                        <select name="2anno-acquisto">
                                          <?php
                                            $now = new DateTime();
                                            $year_now = $now->format('Y');

                                            $a = 0;
                                            while ($a<5) {
                                              echo "<option value=$year_now> $year_now </option>";
                                              $year_now--;
                                              $a++;
                                            }
                                           ?>
                                        </select>
                                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i>
                                        <select name="2mese-acquisto">
                                          <option value="-01"> Gennaio </option>
                                          <option value="-02"> Febbraio </option>
                                          <option value="-03"> Marzo </option>
                                          <option value="-04"> Aprile </option>
                                          <option value="-05"> Maggio </option>
                                          <option value="-06"> Giugno </option>
                                          <option value="-07"> Luglio </option>
                                          <option value="-08"> Agosto </option>
                                          <option value="-09"> Settembre </option>
                                          <option value="-10"> Ottobre </option>
                                          <option value="-11"> Novembre </option>
                                          <option value="-12"> Dicembre </option>
                                        </select>
                                      </div>
                                      <li> <button name="mese-anno-acquisto"> Cerca </button> </li>
                                  </ul>
                                </details>
                              </div>

                              <div class=container-option-ordina>
                                <button name="resetta-filtri" class="btn-resetta-filtri-acquisti"> Resetta filtri </button>
                              </div>

                            </div>

                            <div class="container-acquisti">
                              <div class="div-acquisti">
                                <ul>
                                  <?php

                                    if ((!isset($_POST["1anno-acquisto"])) || (!isset($_POST["mese-anno-acquisto"])) || (isset($_POST["resetta-filtri"]))) {
                                      $sql = "SELECT * FROM acquisto INNER JOIN ordine ON $ordine.IDordine = $acquisto.idordine
                                              WHERE idutente = $IDutente ORDER BY data_ordine DESC";
                                    }

                                    if ((isset($_POST["1anno-acquisto"]))) {
                                      $a1 = $_POST["1anno-acquisto"];
                                      $a2 = $_POST["1anno-acquisto"] + 1;
                                      $s = "-01-01";
                                      $h = "00:00:00";
                                      $anno1 = $a1.$s." ".$h;
                                      $anno2 = $a2.$s." ".$h;
                                      $sql = "SELECT * FROM acquisto INNER JOIN ordine ON $ordine.IDordine = $acquisto.idordine
                                              WHERE idutente = $IDutente AND data_ordine >= '$anno1' AND data_ordine < '$anno2' ORDER BY data_ordine DESC";

                                      $strerr = "nel $a1";
                                    }

                                    if (isset($_POST["mese-anno-acquisto"])) {
                                      $annoS = $_POST["2anno-acquisto"];
                                      $meseS = $_POST["2mese-acquisto"];
                                      $s01 = "-01";
                                      $s31 = "-31";
                                      $h = "00:00:00";
                                      $am01 = $annoS.$meseS.$s01." ".$h;
                                      $am31 = $annoS.$meseS.$s31." ".$h;
                                      $sql = "SELECT * FROM acquisto INNER JOIN ordine ON $ordine.IDordine = $acquisto.idordine
                                              WHERE idutente = $IDutente AND data_ordine >= '$am01' AND data_ordine <= '$am31' ORDER BY data_ordine DESC";

                                      if ($meseS == '-01') { $mm = 'Gennaio'; }
                                      if ($meseS == '-02') { $mm = 'Febbraio'; }
                                      if ($meseS == '-03') { $mm = 'Marzo'; }
                                      if ($meseS == '-04') { $mm = 'Aprile'; }
                                      if ($meseS == '-05') { $mm = 'Maggio'; }
                                      if ($meseS == '-06') { $mm = 'Giugno'; }
                                      if ($meseS == '-07') { $mm = 'Luglio'; }
                                      if ($meseS == '-08') { $mm = 'Agosto'; }
                                      if ($meseS == '-09') { $mm = 'Settembre'; }
                                      if ($meseS == '-10') { $mm = 'Ottobre'; }
                                      if ($meseS == '-11') { $mm = 'Novembre'; }
                                      if ($meseS == '-12') { $mm = 'Dicembre'; }

                                      $strerr = "nel $annoS il mese di $mm";
                                    }

                                    $result = $conn->query($sql);
                                    $num_rows = mysqli_num_rows($result);

                                    if ($num_rows == 0) {
                                      ?>
                                        <div class="empty-cart">
                                          <p> Non hai effettuato alcun ordine <span> <?php echo $strerr ?> </span> </p>
                                        </div>
                                      <?php
                                    }
                                    else {

                                      while ($row = $result->fetch_assoc()) {
                                        $idprodotto_taglia = $row["idprodotto_taglia"];

                                        $sql_P = "SELECT * FROM $prodotto_taglia
                                                 INNER JOIN $prodotto
                                                 ON $prodotto_taglia.idprodotto = $prodotto.IDprodotto
                                                 INNER JOIN $produttore_prodotto
                                                 ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                                                 INNER JOIN $immagine_prodotto
                                                 ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                                                 WHERE IDprodotto_taglia = $idprodotto_taglia";
                                                 $result_P = $conn->query($sql_P);
                                                 $row_P = $result_P->fetch_assoc();
                                                 $imageURL = 'uploads/'.$row_P["file_name"];
                                                 $IDprodotto = $row_P["IDprodotto"];

                                        $sql_taglia = "SELECT * FROM taglia WHERE IDtaglia IN (
                                                       SELECT idtaglia FROM prodotto_taglia WHERE IDprodotto_taglia = $idprodotto_taglia)";
                                                       $result_taglia = $conn->query($sql_taglia);
                                                       $row_taglia = $result_taglia->fetch_assoc();
                              ?>
                                <li>
                                  <div class="img-acquisto">
                                    <?php echo "<a href=./pageProdotto.php?IDprodotto={$IDprodotto} name=compra-di-nuovo>"; ?>
                                      <img src="<?php echo $imageURL; ?>">
                                    </a>
                                  </div>
                                  <div class="c-info-acquisto">
                                    <div class="container-info-acquisto">
                                      <h5> Acquistato il
                                        <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i>
                                        <?php echo $row["data_ordine"] ?>
                                        <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i>
                                        Numero ordine: #<?php echo $row["IDordine"] ?>
                                      </h5>
                                      <h1> <?php echo $row_P["titolo"] ?> </h1>
                                      <h4> Taglia: <?php echo $row_taglia["taglia"] ?> </h4>
                                      <h6> Quantita: <?php echo $row["quantita_acquisto"] ?> </h6>
                                      <p> Costo: <span> €<?php echo $row_P["costo"] * $row["quantita_acquisto"] ?> </span> </p>
                                      <?php echo "<a href=./info.dettagliOrdine.php?IDacquisto={$row["IDacquisto"]} name=compra-di-nuovo title='Dettagli dell'ordine'>"; ?>
                                        <button type="button" class="btn-dettagli-ordine" name="button"> Dettagli dell'ordine </button>
                                      </a>
                                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i>
                                      <?php echo "<a href=./tracciaPacco.php?IDacquisto={$row["IDacquisto"]} name=compra-di-nuovo title='Percorso del pacco'>"; ?>
                                        <button type="button" class="btn-dettagli-ordine" name="button"> Percorso del pacco </button>
                                      </a>
                                    </div>
                                  </div>
                                  <div class="buttons-acquisto">
                                    <div class="container-buttons-acquisto">
                                      <?php echo "<a href=./scriviRecensione.php?IDprodotto={$IDprodotto} name=recensisci-acquisto title='Scrivi una recensione'>"; ?>
                                        <button type="button" class="margin-buttons-acquisto" name="recensisci"> Recensisci </button>
                                      </a>
                                      <?php echo "<a href=./pageProdotto.php?IDprodotto={$IDprodotto} name=compra-di-nuovo title='Compra di nuovo'>"; ?>
                                        <button type="button" name="compra-di-nuovo"> Compralo di nuovo </button>
                                      </a>
                                    </div>
                                  </div>
                                </li>
                              <?php
                                    }
                                  }
                                  ?>
                                    </ul>
                                    </div>
                                    </div>
                                    </div>
                                  <?php
                                }
                              ?>
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

  </body

</html>
