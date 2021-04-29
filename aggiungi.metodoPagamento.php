<!DOCTYPE html>
<html>

  <?php
    session_start();
    if (!isset($_SESSION['email'])) {
      header("Location: ./log.php");
    }

    include './dbConfig/dbConfig.php';

    $email = $_SESSION['email'];
    $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
                 $result_user = $conn->query($sql_user);
                 $row_user = $result_user->fetch_assoc();
                 $IDutente = $row_user["IDutente"];

    $sql = "SELECT * FROM $carrello WHERE idutente = $IDutente";
            $result = $conn->query($sql);
  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.carrello.css">
    <link rel="stylesheet" href="./css/style.mainpage.css">
    <link rel="stylesheet" href="./css/style.pageProdotto.css">
    <link rel="stylesheet" href="./css/style.checkout.css">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

    <div class="background"></div>


      <div class="entire-page">

        <form action="./insert.aggiungi.metodoPagamento.php" method="post">

          <div class="hero">
            <div class="checkout-page">
              <div class="container-checkout-margin">
                <div class="container-checkout">
                  <div class="row-checkout">
                    <div class="col-75">
                      <div class="container">

                          <div class="col-50">
                            <h3> Pagamento </h3>

                            <label> Carte Accettate </label>
                            <div class="icon-container">
                              <i class="fa fa-cc-visa" style="color:navy;"></i>
                              <i class="fa fa-cc-mastercard" style="color:black;"></i>
                              <i class="fa fa-cc-discover" style="color:orange;"></i>
                              <i class="fa fa-cc-amex" style="color:blue;"></i>
                            </div>

                            <label for="cname"> Intestatario della Carta </label>
                            <div class="container-nome-cognome">
                              <input type="text" id="cname" class="margin-input" name="nome-intestatario-ck" placeholder="Mario" required>
                              <input type="text" id="csurname" name="cognome-intestatario-ck" placeholder="Rossi" required>
                            </div>

                            <label for="ccnum"> Numero della Carta </label>
                            <input type="text" id="ccnum" name="numero-carta-ck" minlength="19" maxlength="19" placeholder="1111-2222-3333-4444" pattern="[0-9]{4}-*[0-9]{4}-*[0-9]{4}-*[0-9]{4}" required>

                            <label for="expmonth"> Mese di Scadenza </label>
                              <select id="expmonth" name="mese-scadenza-ck" required>
                                <option class="color-text" value="" selected disabled> Seleziona mese </option>
                                <option value="1"> Gennaio </option>
                                <option value="2"> Febbraio </option>
                                <option value="3"> Marzo </option>
                                <option value="4"> Aprile </option>
                                <option value="5"> Maggio </option>
                                <option value="6"> Giugno </option>
                                <option value="7"> Luglio </option>
                                <option value="8"> Agosto </option>
                                <option value="9"> Settembre </option>
                                <option value="10"> Ottobre </option>
                                <option value="11"> Novembre </option>
                                <option value="12"> Dicembre </option>
                              </select>
                            <div class="row-checkout">
                              <div class="col-50">
                                <label for="expyear"> Anno di Scadenza </label>
                                <input type="number" id="expyear" name="anno-scadenza-ck" minlength="4" maxlength="4" placeholder="2021" required>
                              </div>
                              <div class="col-50">
                                <label for="cvv"> CVV </label>
                                <input type="number" id="cvv" name="cvv-ck" minlength="3" maxlength="3" placeholder="123" required>
                              </div>
                            </div>
                            <button type="submit" class="btn-checkout" name="conferma-aggiungi-metodoP"> Aggiungi nuovo metodo di pagamento </button>
                          </div>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </form>

      </div>

    <button onclick="topFunction()" id="myBtn" title="Go to top"> </button>

    <script src="./js/main.js"></script>

  </body

</html>
