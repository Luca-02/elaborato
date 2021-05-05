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
  
    $sql = "SELECT * from $utenti where email = '$_SESSION[email]'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $user = $row['username'];
    $nome = $row['nome'];
    $cognome = $row['cognome'];
    $email = $row['email'];
    $IDutente = $row["IDutente"];

  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Account Info </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.mainpage.css">
    <link rel="stylesheet" href="./css/style.log.css">
    <link rel="stylesheet" href="./css/style.pageProdotto.css">
    <link rel="stylesheet" href="./css/style.profile.css">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

    <div class="background"></div>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
      <div class="box-shadow" id=box-metodi>

          <div class="profile-img">
            <img src="./immagini/img_avatar.png" alt="logo">
          </div>

          <div class="title">
            <h2> <?php echo "$nome $cognome" ?> </h2>
            <h3> <?php echo $user; ?> </h3>
          </div>
        <hr>

        <div class="container-elenco-metodi-pagamento">

          <?php
            $sql_count_metodi = "SELECT count(*) as cont_metodi FROM metodo_pagamento WHERE idutente = $IDutente";
                                 $result_count_metodi = $conn->query($sql_count_metodi);
                                 $row_count_metodi = $result_count_metodi->fetch_assoc();

            if ($row_count_metodi["cont_metodi"] == 0) {
              ?>
                <div class="nessun-metodo-pagamento">
                  Non è presente nessun metodo di pagamento
                </div>
              <?php
            }
            else {
              $sql_selectmetodi = "SELECT * FROM metodo_pagamento WHERE idutente = $IDutente";
                                   $result_selectmetodi = $conn->query($sql_selectmetodi);

              $count_metodi = 0;

              while ($row_selectmetodi = $result_selectmetodi->fetch_assoc()) {
                $count_metodi++;
                if ($count_metodi == 1) {
                  ?>
                    <div class="elenco-metodo-pagamento">
                      Metodo <?php echo $count_metodi ?>
                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "**** **** **** "; echo substr($row_selectmetodi["numero_carta"], -4); ?>
                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "{$row_selectmetodi["cognome_intestatario"]} {$row_selectmetodi["nome_intestatario"]}" ?>
                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i>
                      <button type="submit" class="btn-elimina-metodo-pagamento" value="<?php echo $row_selectmetodi["IDmetodo_pagamento"] ?>" name="elimina-metodo-pagamento"> Elimina </button>
                    </div>
                  <?php
                }
                else {
                  ?>
                    <div class="elenco-metodo-pagamento">
                      Metodo <?php echo $count_metodi ?>
                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "**** **** **** "; echo substr($row_selectmetodi["numero_carta"], -4); ?>
                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i> <?php echo "{$row_selectmetodi["cognome_intestatario"]} {$row_selectmetodi["nome_intestatario"]}" ?>
                      <i class="a-icon a-icon-text-separator sc-action-separator" role="img" aria-label="|"></i>
                      <button type="submit" class="btn-elimina-metodo-pagamento" value="<?php echo $row_selectmetodi["IDmetodo_pagamento"] ?>" name="elimina-metodo-pagamento"> Elimina </button>
                    </div>
                  <?php
                }
              }
            }

            if (isset($_POST["elimina-metodo-pagamento"])) {
              $IDmetodo_pagamento = $_POST["elimina-metodo-pagamento"];
              $sql_delete = "DELETE FROM metodo_pagamento WHERE IDmetodo_pagamento = $IDmetodo_pagamento";
              if ($conn->query($sql_delete)) {
                header('Location: '.$_SERVER['PHP_SELF']);
              }
              else {
                echo "Error deleting record: " . mysqli_error($conn);
              }
            }
           ?>

          <a href="./aggiungi.metodoPagamento.php"> <button type="button" class="button-nuovo-metodo" name="nuovo-metodoP"> Aggiungi un nuovo metodo </button> </a>

        </div>

        <hr>
          <div class="register">
            <a href="./avatarInfo.php"> <i class="fa fa-arrow-left"></i> Torna indietro </a>
          </div>
      </div>

    </form>

  </body>

</html>
