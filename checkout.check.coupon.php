<?php
  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include './dbConfig/dbConfig.php';
  include './dbConfig/dbConfig_coupon.php';

  $IDutente = $_SESSION['IDutente'];

  $nome_completo_ck = $_SESSION['nome_completo_ck'];
  $cognome_completo_ck = $_SESSION['cognome_completo_ck'];
  $email_ck = $_SESSION['email_ck'];
  $indirizzo_ck = $_SESSION['indirizzo_ck'];
  $citta_ck = $_SESSION['citta_ck'];
  $provincia_ck = $_SESSION['provincia_ck'];
  $cap_ck = $_SESSION['cap_ck'];
  $latitudine = $_SESSION['latitudine'];
  $longitudine = $_SESSION['longitudine'];
  $altitudine = $_SESSION['altitudine'];

  $IDmetodo_pagamento = $_SESSION['IDmetodo_pagamento'];
  $saldo_speso = $_SESSION['saldo_speso'];

  $scelta_coupon = mysqli_real_escape_string($conn, $_POST['scelta-coupon']);

  if ($scelta_coupon == 0) {
    session_start();
    $coupon_text = NULL;
    $_SESSION['coupon_text'] = $coupon_text;
    header("Location: ./checkout.contoFinale.php");
  }
  else {

?>

<!DOCTYPE html>
<html>

  <?php
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

        <form action="./checkout.confirm.coupon.php" method="post">

          <div class="hero">
            <div class="checkout-page">
              <div class="container-checkout-margin">
                <div class="container-checkout">
                  <div class="row-checkout">

                    <div class="col-75">
                      <div class="container20">

                          <div class="row-checkout">

                            <div class="col-50">
                              <h3> Inserisci il coupon </h3>
                              <div class="container-metodiP">
                                  <input type="text" class="text-coupon" maxlength="20" name="coupon-text" required>
                              </div>
                            </div>

                          </div>
                          <button type="submit" class="btn-checkout" name="btn-conferma-coupon"> Conferma coupon </button>
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

<?php
  }
?>
