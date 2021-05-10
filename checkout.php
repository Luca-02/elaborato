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

        <form action="./confirm.checkout.php" method="post">

          <div class="hero">
            <div class="checkout-page">
              <div class="container-checkout-margin">
                <div class="container-checkout">
                  <div class="row-checkout">

                    <div class="col-75">
                      <div class="container">

                          <div class="row-checkout">
                            <div class="col-50">
                              <h3> Indirizzo di fatturazione </h3>

                              <label for="fname"><i class="fa fa-user"></i> Nome e Cognome</label>
                              <div class="container-nome-cognome">
                                <input type="text" id="fname" class="margin-input" name="nome-completo-ck" placeholder="Mario" required>
                                <input type="text" id="fsurname" name="cognome-completo-ck" placeholder="Rossi" required>
                              </div>

                              <label for="email"><i class="fa fa-envelope"></i> Email</label>
                              <input type="text" id="email" name="email-ck" maxlength="50" placeholder="mario.rossi@gmail.com" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>

                              <label for="adr"><i class="fa fa-address-card-o"></i> Indirizzo </label>
                              <input type="text" id="adr" name="indirizzo-ck" placeholder="Via e numero civico" required>

                              <label for="city"><i class="fa fa-institution"></i> Città </label>
                              <input type="text" id="city" name="citta-ck" placeholder="Città" required>

                              <div class="row-checkout">
                                <div class="col-50">
                                  <label for="state"> Provincia </label>
                                  <input type="text" id="state" name="provincia-ck" placeholder="Provincia" required>
                                </div>
                                <div class="col-50">
                                  <label for="zip"> CAP </label>
                                  <input type="number" id="zip" minlength="5" maxlength="5" name="cap-ck" maxlength="5" placeholder="10001" required>
                                </div>
                              </div>

                              <label for="fname"><i class="fa fa-map-marker"></i> Coordinate consegna (il drone consegnerà esattamente a queste coordinate) </label>
                              <div class="container-nome-cognome">
                                <input type="number" class="margin-input" name="latitudine-ck" minlength="1" maxlength="25" step="any" placeholder="Latitudine" required>
                                <input type="number" class="margin-input" name="longitudine-ck" minlength="1" maxlength="25" step="any" placeholder="Longitudine" required>
                                <input type="number" name="altitudine-ck" minlength="1" maxlength="25" step="any" placeholder="Altitudine" required>
                              </div>

                            </div>

                            <?php
                              $sql_metodo = "SELECT count(*) as count_metodi FROM metodo_pagamento WHERE idutente = $IDutente";
                                             $result_metodo = $conn->query($sql_metodo);
                                             $row_metodo = $result_metodo->fetch_assoc();
                              if ($row_metodo["count_metodi"] == 0) {
                                ?>
                                    <div class="col-50">
                                      <h3> Pagamento </h3>
                                      <a href="./aggiungi.metodoPagamento.php"> <button type="button" class="btn-metodoP" name="btn-metodo-pagamento"> Aggiungi metodo di pagamento </button> </a>
                                    </div>
                                  </div>
                                <?php
                              }
                              else {
                                ?>
                                    <div class="col-50">
                                      <h3> Pagamento </h3>
                                      <label><i class="fa fa-credit-card"></i> Seleziona Metodo di Pagamento </label>
                                      <div class="container-metodiP">
                                          <?php
                                            $sql_selectmetodi = "SELECT * FROM metodo_pagamento WHERE idutente = $IDutente";
                                                    $result_selectmetodi = $conn->query($sql_selectmetodi);

                                            $count_metodi = 0;

                                            while ($row_selectmetodi = $result_selectmetodi->fetch_assoc()) {
                                              $count_metodi++;
                                              if ($count_metodi == 1) {
                                                ?>
                                                  <div class="metodiP">
                                                    <input type="radio" name="metodo-pagamento" checked="checked" value="<?php echo $row_selectmetodi["IDmetodo_pagamento"] ?>">
                                                    Metodo <?php echo $count_metodi ?>
                                                    <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "**** **** **** "; echo substr($row_selectmetodi["numero_carta"], -4); ?>
                                                    <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "{$row_selectmetodi["cognome_intestatario"]} {$row_selectmetodi["nome_intestatario"]}" ?>
                                                  </div>
                                                <?php
                                              }
                                              else {
                                                ?>
                                                  <div class="metodiP">
                                                    <input type="radio" name="metodo-pagamento" value="<?php echo $row_selectmetodi["IDmetodo_pagamento"] ?>">
                                                    Metodo <?php echo $count_metodi ?>
                                                    <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "**** **** **** "; echo substr($row_selectmetodi["numero_carta"], -4); ?>
                                                    <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "{$row_selectmetodi["cognome_intestatario"]} {$row_selectmetodi["nome_intestatario"]}" ?>
                                                  </div>
                                                <?php
                                              }
                                            }
                                           ?>
                                      </div>
                                    </div>
                                  </div>
                                  <?php
                                    echo "<button type=submit class=btn-checkout name=btn-conferma-checkout value=$IDutente> Ordina e paga </button>";
                                  ?>
                                <?php
                              }
                             ?>

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

  </body

</html>
