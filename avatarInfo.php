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

  ?>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Account Info </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.mainpage.css">
    <link rel="stylesheet" href="./css/style.log.css">
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
            <h2> <?php echo "$nome <br> $cognome" ?> </h2>
            <h3> <?php echo $user; ?> </h3>
          </div>
        <hr>

          <div class="container-btn-profile">
            <a href="./infoAccount.php" class="btn-profile"> <p> Le tue informazioni </p> </a>
            <a href="./cronologiaAcquisti.php" class="btn-profile"> <p> I tuoi acquisti </p> </a>
            <a href="./metodiPagamento.php" class="btn-profile"> <p> I tuoi metodi di pagamento </p> </a>
            <a href="./logout.php" class="btn-profile"> <p> Logout </p> </a>
          </div>

        <hr>
          <div class="register">
            <a href="./mainPageLogin.php"> <i class="fa fa-arrow-left"></i> Torna alla home </a>
          </div>
      </div>
    </form>

  </body>

</html>
