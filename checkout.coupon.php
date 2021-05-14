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

    if (isset($_POST["btn-conferma-checkout"])) {
      $IDutente = $_POST["btn-conferma-checkout"];

      $nome_completo_ck = mysqli_real_escape_string($conn, $_POST["nome-completo-ck"]);
      $cognome_completo_ck = mysqli_real_escape_string($conn, $_POST["cognome-completo-ck"]);
      $email_ck = mysqli_real_escape_string($conn, $_POST["email-ck"]);
      $indirizzo_ck = mysqli_real_escape_string($conn, $_POST['indirizzo-ck']);
      $citta_ck = mysqli_real_escape_string($conn, $_POST['citta-ck']);
      $provincia_ck = mysqli_real_escape_string($conn, $_POST['provincia-ck']);
      $cap_ck = mysqli_real_escape_string($conn, $_POST['cap-ck']);
      $latitudine = mysqli_real_escape_string($conn, $_POST['latitudine-ck']);
      $longitudine = mysqli_real_escape_string($conn, $_POST['longitudine-ck']);
      $altitudine = mysqli_real_escape_string($conn, $_POST['altitudine-ck']);

      $IDmetodo_pagamento = mysqli_real_escape_string($conn, $_POST['metodo-pagamento']);
      $saldo_speso = mysqli_real_escape_string($conn, $_POST['costo_spesa']);

      $_SESSION['IDutente'] = $IDutente;

      $_SESSION['nome_completo_ck'] = $nome_completo_ck;
      $_SESSION['cognome_completo_ck'] = $cognome_completo_ck;
      $_SESSION['email_ck'] = $email_ck;
      $_SESSION['indirizzo_ck'] = $indirizzo_ck;
      $_SESSION['citta_ck'] = $citta_ck;
      $_SESSION['provincia_ck'] = $provincia_ck;
      $_SESSION['cap_ck'] = $cap_ck;
      $_SESSION['latitudine'] = $latitudine;
      $_SESSION['longitudine'] = $longitudine;
      $_SESSION['altitudine'] = $altitudine;

      $_SESSION['IDmetodo_pagamento'] = $IDmetodo_pagamento;
      $_SESSION['saldo_speso'] = $saldo_speso;
    }

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

        <form action="./checkout.check.coupon.php" method="post">

          <div class="hero">
            <div class="checkout-page">
              <div class="container-checkout-margin">
                <div class="container-checkout">
                  <div class="row-checkout">

                    <div class="col-75">
                      <div class="container20">

                          <div class="row-checkout">

                            <div class="col-50">
                              <h3> Coupon </h3>
                              <label> Vuoi utilizzare un coupon? </label>
                              <div class="container-metodiP">

                                <div class="metodiP">
                                  <input type="radio" name="scelta-coupon" checked="checked" value="0">
                                  No
                                </div>

                                <div class="metodiP">
                                  <input type="radio" name="scelta-coupon" value="1">
                                  Si
                                </div>
                              </div>
                            </div>

                          </div>
                          <button type="submit" class="btn-checkout" name="btn-coupon"> Avanti </button>
                      </div>
                    </div>



                    <div class="col-25">
                      <div class="container-cart">
                        <h4> Carrello <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b> 4 </b> </span> </h4>
                        <div class="carrello-checkout">
                          <?php
                            $cont = 0;
                            $prezzo_tot = 0;
                            while ($row = $result->fetch_assoc()) {
                              $cont++;
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

                              $prezzo_parz = $row2["costo"] * $row_qta["quantita_carrello"];
                              $prezzo_tot = $prezzo_tot + $prezzo_parz;
                              ?>
                                <div class="text-prodotto-checkout">
                                  <?php echo "<a href=./pageProdotto.php?IDprodotto={$row2['IDprodotto']}>" ?> <p> <?php echo "{$row2["titolo"]} ({$row3["taglia"]})"?> <span> (Q.tà: <?php echo $quantita_carrello_prod ?>) </span> </p> </a>
                                  <span> €<?php echo $prezzo_parz ?> </span>
                                </div>
                              <?php
                            }
                           ?>
                        </div>
                        <hr>
                        <h5> Total <span class="price" style="color:black"><b style="text-decoration: underline;"> €<?php echo $prezzo_tot ?> </b></span> </h5>
                        <input type="text" class="input-costo-spesa" name="costo_spesa" value="<?php echo "$prezzo_tot" ?>">
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

  </body>

</html>
