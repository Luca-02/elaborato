<!DOCTYPE html>
<html>

  <?php
    session_start();
    if (!isset($_SESSION['email'])) {
      header("Location: ./log.php");
    }

    include './dbConfig/dbConfig.php';

    $IDacquisto = $_GET['IDacquisto'];

    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
                 $result_user = $conn->query($sql_user);
                 $row_user = $result_user->fetch_assoc();
                 $IDutente = $row_user["IDutente"];

    $sql = "SELECT * FROM acquisto INNER JOIN ordine ON $ordine.IDordine = $acquisto.idordine
            WHERE IDacquisto = '$IDacquisto'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();

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
            <a href="./mainPageTop10P.php" class="button2-a"> <button class="button2 logged" name="button2-Top10"> Top 10 più venduti </button> </a>
          </div>

          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

            <div class="dettagliOrdine">
              <div class="container-dettagliOrdine">

                  <h1> Dettagli dell'ordine </h1>
                  <div class="text-info-ordine">
                    <div class="text-IO1 text-mod-color">
                      <h2> Data dell'ordine </h2>
                      <h2> Numero ordine </h2>
                      <h2> Totale ordine </h2>
                    </div>
                    <div class="text-IO2">
                      <h2> <?php echo $row["data_ordine"] ?> </h2>
                      <h2> #<?php echo $row["IDordine"] ?> </h2>
                      <h2> €<?php echo $row_P["costo"] * $row["quantita_acquisto"] ?>
                        <span class="text-mod-color">(<?php
                          echo $row["quantita_acquisto"];
                          if ($row["quantita_acquisto"] == 1) {
                            echo " articolo";
                          }
                          else {
                            echo " articoli";
                          }
                        ?>)</span>
                      </h2>
                    </div>
                  </div>
                <hr>
                  <h1> Dettagli prodotto </h1>
                  <div class="text-info-ordine">
                    <div class="text-IO10">
                      <?php echo "<a href=./pageProdotto.php?IDprodotto={$IDprodotto} name=compra-di-nuovo>"; ?>
                        <img src="<?php echo $imageURL; ?>"  class="img-prodotto-dettagli-ordine">
                      </a>
                    </div>
                    <div class="text-IO20">
                      <h3 class="text-capitalize"> <?php echo $row_P["titolo"] ?> </h3>
                      <div class="text-mod-color">
                        <h2> Quantità: <?php echo $row["quantita_acquisto"] ?> </h2>
                        <h2> Taglia: <?php echo $row_taglia["taglia"] ?> </h2>
                      </div>
                    </div>
                  </div>
                <hr>
                  <h1> Informazioni di pagamento </h1>
                  <h3> Metodo di pagamento </h3>
                  <h2> Carta di credito </h2>
                  <br>
                  <h3> Indirizzo di fatturazione </h3>
                  <h2> <?php echo $row["indirizzo"] ?> </h2>
                  <h2> <?php echo $row["provincia"] ?> </h2>
                  <h2> <?php echo $row["citta"] ?> </h2>
                  <h2> <?php echo $row["cap"] ?> </h2>
                <hr>
                  <h1> Indirizzo di spedizione </h1>
                  <h2> <?php echo "{$row["nome_destinatario"]} {$row["cognome_destinatario"]}" ?> </h2>
                  <h2> <?php echo $row["indirizzo"] ?> </h2>
                  <h2> <?php echo "{$row["provincia"]}, {$row["citta"]} {$row["cap"]}" ?> </h2>
                <hr>
                <div class="text-info-ordine">
                  <div class="text-btm1">
                    <h3> Totale ordine </h3>
                  </div>
                  <div class="text-btm2">
                    <h3 class="prezzo-ordine"> €<?php echo $row_P["costo"] * $row["quantita_acquisto"] ?> </h3>
                  </div>
                </div>

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

  </body

</html>
