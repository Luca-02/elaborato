<!DOCTYPE html>
<html>

  <?php
    session_start();
    if(!isset($_SESSION['email'])) {
      header("Location: ./log.php");
    }

    include 'dbConfig.php';

    $sql_max_costo = "SELECT MAX(costo) as max_costo FROM $prodotto";
    $result_max_costo = $conn->query($sql_max_costo);
    $row_max_costo = $result_max_costo->fetch_assoc();
    $max_costo_arrot = ceil($row_max_costo["max_costo"]);
  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.mainpage.css">
    <link rel="stylesheet" href="./css/style.tabellaProdotti.css">
    <link rel="stylesheet" href="./css/style.tipoAbito.css">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>

    <div class="background"></div>

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
          <div class="header2">
            <nav>
              <ul class="shortcut2">
                <li> <button class="tutti" name="tutti-i-prodotti-tutto"> Tutti i prodotti </button> </li>
              </ul>
            </nav>
          </div>

          <div class="header2 sticky-header">
            <div class="container">
              <p class="button-tipo-prodotti click" name="button2-1" title="Abbigliamento"> Abbigliamento </p>
                <div class="list">
                  <?php
                    $sql = "SELECT * FROM $calzatura_oggetto
                            WHERE idtipo_oggetto IN (
                            SELECT IDtipo_oggetto FROM $tipo_oggetto WHERE nome = 'Abbigliamento')";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {
                      echo "<button class='links links-color' name=bottone-prodotti value={$row['IDcalzatura_oggetto']}>
                              {$row['nome']}
                            </button>";
                    }
                   ?>
                </div>
            </div>
            <div class="container">
              <p class="button-tipo-prodotti click2" name="button2-1" title="Borse"> Borse </p>
                <div class="list2">
                  <?php
                    $sql = "SELECT * FROM $calzatura_oggetto
                            WHERE idtipo_oggetto IN (
                            SELECT IDtipo_oggetto FROM $tipo_oggetto WHERE nome = 'Borse')";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {
                      echo "<button class='links links-color' name=bottone-prodotti value={$row['IDcalzatura_oggetto']}>
                              {$row['nome']}
                            </button>";
                    }
                   ?>
                </div>
            </div>
            <div class="container">
              <p class="button-tipo-prodotti click3" name="button2-1" title="Calzature"> Calzature </p>
                <div class="list3">
                  <?php
                    $sql = "SELECT * FROM $calzatura_oggetto
                            WHERE idtipo_oggetto IN (
                            SELECT IDtipo_oggetto FROM $tipo_oggetto WHERE nome = 'Calzature')";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {
                      echo "<button class='links links-color' name=bottone-prodotti value={$row['IDcalzatura_oggetto']}>
                              {$row['nome']}
                            </button>";
                    }
                   ?>
                </div>
            </div>
            <div class="container">
              <p class="button-tipo-prodotti click4" name="button2-1" title="Accessori"> Accessori </p>
                <div class="list4">
                  <?php
                    $sql = "SELECT * FROM $calzatura_oggetto
                            WHERE idtipo_oggetto IN (
                            SELECT IDtipo_oggetto FROM $tipo_oggetto WHERE nome = 'Accessori')";
                    $result = $conn->query($sql);

                    while($row = $result->fetch_assoc()) {
                      echo "<button class='links links-color' name=bottone-prodotti value={$row['IDcalzatura_oggetto']}>
                              {$row['nome']}
                            </button>";
                    }
                   ?>
                </div>
            </div>
          </div>

          <div class="prodotti">

            <div class="cerca">
              <div class="cerca-container" style="margin:auto;">
                <input type="text" placeholder="Cerca..." name="cerca-str" title="Cerca">
                <button class="btn-cerca" type="submit" name="btn-cerca-str" title="Trova"> <i class="fa fa-search"></i> </button>
              </div>
            </div>

            <div class="container-option">
                <div class="container-option-ordina-opzioni">
                  <details>
                    <summary> Prezzo </summary>
                      <ul>
                        <div class="prezzo-container">
                          <?php echo
                          "<input type=range min=1 max={$max_costo_arrot} value=1 name=prezzo-slider id=myRange>";
                          ?>
                          <div class="container-max-prezzo">
                            <p> MAX € </p> <textarea name="max-prezzo" minlength="1" maxlength="4" rows="1" cols="3" id=maxP></textarea>
                          </div>
                        </div>
                        <li> <button name="prezzo"> Cerca </button> </li>
                      </ul>
                  </details>

                  <details>
                    <summary> Brand </summary>
                    <ul>
                      <?php
                        $sql_produttori = "SELECT DISTINCT $produttore_prodotto.IDproduttore_prodotto, produttore
                                           FROM $prodotto INNER JOIN $produttore_prodotto
                                           ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                                           ORDER BY produttore";
                        $result_produttori = $conn->query($sql_produttori);

                          while($row_produttori = $result_produttori->fetch_assoc()) {
                           echo "<li>
                                    <button name=btn-produttore value={$row_produttori['IDproduttore_prodotto']}>
                                       {$row_produttori['produttore']}
                                    </button>
                                 </li>";
                          }
                       ?>
                    </ul>
                  </details>

                  <details>
                    <summary> Colore </summary>
                    <ul>
                      <?php
                        $sql_colore = "SELECT DISTINCT $colore_prodotto.IDcolore_prodotto, nome_colore, codice_colore
                                       FROM $prodotto INNER JOIN $colore_prodotto
                                       ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                                       ORDER BY nome_colore";
                        $result_colore = $conn->query($sql_colore);

                          while($row_colore = $result_colore->fetch_assoc()) {
                            echo "<li>
                                    <button name=btn-colore value={$row_colore['IDcolore_prodotto']}>
                                       {$row_colore['nome_colore']}
                                    </button>
                                  </li>";
                          }
                       ?>
                    </ul>
                  </details>

                  <details>
                    <summary> Sesso </summary>
                    <ul>
                      <?php
                        $sql_tipo_calzatura = "SELECT * FROM $tipo_calzatura";
                        $result_tipo_calzatura = $conn->query($sql_tipo_calzatura);

                          while($row_tipo_calzatura = $result_tipo_calzatura->fetch_assoc()) {
                            echo "<li>
                                    <button name=btn-tipo-calzatura value={$row_tipo_calzatura['IDtipo_calzatura']}>
                                       {$row_tipo_calzatura['tipo']}
                                    </button>
                                  </li>";
                          }
                       ?>
                    </ul>
                  </details>

                </div>

                <div class=container-option-ordina>
                  <details>
                    <summary> Ordina tutti i prodotti per </summary>
                    <ul>
                      <li> <button name="prezzo-crescente"> Prezzo crescente </button> </li>
                      <li> <button name="prezzo-decrescente"> Prezzo decrescente </button> </li>
                      <li> <button name="titolo-alfabetico-az"> Titolo (A-Z) </button> </li>
                      <li> <button name="titolo-alfabetico-za"> Titolo (Z-A) </button> </li>
                      <li> <button name="produttore-alfabetico-az"> Produttore (A-Z) </button> </li>
                      <li> <button name="produttore-alfabetico-za"> Produttore (Z-A) </button> </li>
                      <li> <button name="prezzo-piu-comprati"> Più comprati </button> </li>
                    </ul>
                  </details>
                </div>
              </div>

            <!-- <ul class="prodotti-ul"> -->
              <?php

                if ((!isset($_POST["bottone-prodotti"])) || (isset($_POST["tutti-i-prodotti-tutto"]))) {
                    $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                            ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                            INNER JOIN $produttore_prodotto
                            ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                            INNER JOIN $immagine_prodotto
                            ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                            WHERE idoggetto IN (
                            SELECT IDoggetto FROM $oggetto WHERE idcalzatura_oggetto IN (
                            SELECT IDcalzatura_oggetto FROM $calzatura_oggetto WHERE idtipo_calzatura IN (
                            SELECT IDtipo_calzatura FROM $tipo_calzatura)
                            ))";
                }


                if (isset($_POST["bottone-prodotti"])) {
                    $IDcalzatura_oggetto = $_POST["bottone-prodotti"];
                    $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                            ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                            INNER JOIN $produttore_prodotto
                            ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                            INNER JOIN $immagine_prodotto
                            ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                            WHERE idoggetto IN (
                            SELECT IDoggetto FROM $oggetto WHERE idcalzatura_oggetto IN (
                            SELECT IDcalzatura_oggetto FROM $calzatura_oggetto WHERE IDcalzatura_oggetto = $IDcalzatura_oggetto
                            ))";

                }


                if (isset($_POST["btn-produttore"])) {
                    $IDproduttore = $_POST["btn-produttore"];

                    $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                    ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                    INNER JOIN $produttore_prodotto
                    ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                    INNER JOIN $immagine_prodotto
                    ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                    WHERE $prodotto.idproduttore_prodotto IN (
                    SELECT IDproduttore_prodotto FROM $produttore_prodotto WHERE IDproduttore_prodotto = $IDproduttore
                    )";
                }


                if (isset($_POST["btn-colore"])) {
                    $IDcolore = $_POST["btn-colore"];

                    $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                    ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                    INNER JOIN $produttore_prodotto
                    ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                    INNER JOIN $immagine_prodotto
                    ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                    WHERE $prodotto.idcolore_prodotto IN (
                    SELECT IDcolore_prodotto FROM $colore_prodotto WHERE IDcolore_prodotto = $IDcolore
                    )";
                }


                if (isset($_POST["btn-cerca-str"])) {
                  $str_cerca = strtolower($_POST["cerca-str"]);

                  $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                          ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                          INNER JOIN $produttore_prodotto
                          ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                          INNER JOIN $immagine_prodotto
                          ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                          WHERE titolo LIKE '%$str_cerca%' OR produttore LIKE '%$str_cerca%'";
                }


                if (isset($_POST["prezzo"])) {
                  $max_prezzo = $_POST["max-prezzo"];

                  $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                          ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                          INNER JOIN $produttore_prodotto
                          ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                          INNER JOIN $immagine_prodotto
                          ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                          WHERE idoggetto IN (
                          SELECT IDoggetto FROM $oggetto WHERE idcalzatura_oggetto IN (
                          SELECT IDcalzatura_oggetto FROM $calzatura_oggetto WHERE idtipo_calzatura IN (
                          SELECT IDtipo_calzatura FROM $tipo_calzatura)
                          ))
                          AND costo <= $max_prezzo ";
                }


                if (isset($_POST["btn-tipo-calzatura"])) {
                  $id_tipo_calzatura = $_POST["btn-tipo-calzatura"];

                  $sql = "SELECT * FROM $prodotto INNER JOIN $colore_prodotto
                          ON $prodotto.idcolore_prodotto = $colore_prodotto.IDcolore_prodotto
                          INNER JOIN $produttore_prodotto
                          ON $prodotto.idproduttore_prodotto = $produttore_prodotto.IDproduttore_prodotto
                          INNER JOIN $immagine_prodotto
                          ON $prodotto.idimmagine_prodotto  = $immagine_prodotto.IDimmagine_prodotto
                          WHERE idoggetto IN (
                          SELECT IDoggetto FROM $oggetto WHERE idcalzatura_oggetto IN (
                          SELECT IDcalzatura_oggetto FROM $calzatura_oggetto WHERE idtipo_calzatura IN (
                          SELECT IDtipo_calzatura FROM $tipo_calzatura WHERE IDtipo_calzatura = '$id_tipo_calzatura')
                          ))";
                }


                    if ((!isset($_POST["prezzo-crescente"])) && (!isset($_POST["prezzo-decrescente"])) &&
                    (!isset($_POST["produttore-alfabetico-az"])) && (!isset($_POST["produttore-alfabetico-za"])) &&
                    (!isset($_POST["titolo-alfabetico-az"])) && (!isset($_POST["titolo-alfabetico-za"]))) {
                      $sql .= "ORDER BY titolo";
                    }

                    if (isset($_POST["prezzo-crescente"])) {
                      $sql .= "ORDER BY costo";
                    }
                    if (isset($_POST["prezzo-decrescente"])) {
                      $sql .= "ORDER BY costo DESC";
                    }

                    if (isset($_POST["produttore-alfabetico-az"])) {
                      $sql .= "ORDER BY produttore";
                    }
                    if (isset($_POST["produttore-alfabetico-za"])) {
                      $sql .= "ORDER BY produttore DESC";
                    }

                    if (isset($_POST["titolo-alfabetico-az"])) {
                      $sql .= "ORDER BY titolo";
                    }
                    if (isset($_POST["titolo-alfabetico-za"])) {
                      $sql .= "ORDER BY titolo DESC";
                    }

                      $result = $conn->query($sql);
                      $num_rows = mysqli_num_rows($result);

                      if ($num_rows == 0) {
                        ?>
                          <div class="empty-prodotti">
                            <p> Non sono presenti prodotti su questo filtro </p>
                          </div>
                        <?php
                      }
                      else {
                        ?>
                          <ul class="prodotti-ul">
                        <?php
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
                <?php
                }
              ?>

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

  </body

</html>
