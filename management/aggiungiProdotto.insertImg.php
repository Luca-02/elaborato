<!DOCTYPE html>
<html>

  <?php
    session_start();
    // if (!isset($_SESSION['email'])) {
    //   header("Location: ./log.php");
    // }

    include '../dbConfig/dbConfig.php';

    $idprodotto = $_SESSION['idprodotto'];

    $sql = "SELECT * FROM prodotto WHERE IDprodotto = '$idprodotto'";
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Milanesi Commerce Management </title>
    <link rel="icon" href="../immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.management.css">
  </head>

  <body>

    <div class="header-page">
      <div class="header">
        <p> Accesso effettuato da: id nome cognome mail </p>
      </div>
    </div>

    <br>

    <form action="./aggiungiProdotto.uploadImg.php" method="post" enctype="multipart/form-data">

      <div class="insert-prodotto">
        Selezionare l'immagine di "<?php echo $row["titolo"] ?>"
        <input type="file" name="file">
        <br>

        <button type="submit" name="submit" value="<?php echo $idprodotto ?>"> Upload </button>
      </div>
      
    </form>

  </body

</html>
