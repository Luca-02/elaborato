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

    if ($IDprodotto) {
      $sql = "SELECT * FROM $prodotto WHERE IDprodotto = $IDprodotto";
      $result = $conn->query($sql);
      $row = $result->fetch_assoc();
    }
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

          <div class="container-scrivi-recensione">
            <div class="text-scrivi-recensione">
              <h1> Recensisci </h1>
              <h2> <?php echo $row["titolo"] ?> </h2>
              <div class="valutazione-text-scrivi-recensione">
                <span class="fa fa-star checked"></span>
                <select name="seleziona-stelle" required>
                  <option value="" selected disabled> Seleziona stelle </option>
                  <option value="1"> 1 </option>
                  <option value="2"> 2 </option>
                  <option value="3"> 3 </option>
                  <option value="4"> 4 </option>
                  <option value="5"> 5 </option>
                </select>
                <span class="fa fa-star checked"></span>
              </div>
              <textarea name="titolo-recensione" placeholder="Aggiungi un titolo alla recensione (max 50 caratteri)..." maxlength="50" rows="1" cols="100" required></textarea>
              <br>
              <textarea name="testo-recensione" placeholder="Scrivi una recensione (max 1500 caratteri)..." minlength="5" maxlength="1500" rows="15" cols="100" required></textarea>
              <div class="btn-recensisci">
                 <button type="submit" name="bottone-insert-recensione" value="<?php echo $IDprodotto ?>" title="Recensisci"> Recensisci </button>
              </div>

              <?php
                if (isset($_POST["bottone-insert-recensione"])) {

                  $valutazione = $_POST['seleziona-stelle'];
                  $txt = mysqli_real_escape_string($conn, $_POST['testo-recensione']);
                  $titolo = mysqli_real_escape_string($conn, $_POST['titolo-recensione']);

                  $email = $_SESSION['email'];
                  $sql = "SELECT * from $utenti WHERE email = '$email'";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  $IDutente = $row["IDutente"];

                  $IDprodotto = $_POST["bottone-insert-recensione"];
                  $sql2 = "INSERT INTO recensioni (testo_recensione, titolo_recensione, valutazione, data_recensione, idutente, idprodotto)
                           VALUES ('$txt', '$titolo', '$valutazione', NOW(), '$IDutente', '$IDprodotto')";
                  if($conn->query($sql2))
                  {
                    header('location: pageProdotto.php?IDprodotto='. $IDprodotto);
                  }
                  else
                  {
                    echo "<p class=errore> Errore nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
                  }

                }
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
