<!DOCTYPE html>

  <?php
    include './dbConfig/dbConfig.php';
  ?>

<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Login </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.log.css">
    <link rel="stylesheet" href="./css/background.css">

  </head>

  <body>

    <div class="background"></div>

    <form action="./check.log.php" method="post">

        <div class="box-shadow" id=box>

            <div class="title"> <h1> Accedi </h1> </div>
          <hr>
            <div class="box-log-container">
              <input type="text" class="data" maxlength="50" placeholder="Email" name="email" required>
              <input type="password" class="data" minlength="8" maxlength="30" placeholder="Password" name="password" id="MyPass" required>
              <div class="show-pass">
                <input type="checkbox" onclick="showPass()"> Show Password
              </div>
              <input type="submit" class="singin" value="Accedi" name="accedi" required>
            </div>
          <hr>
          <p class=errore> Identificazione non riuscita: email o password errate, riprovare </p>
            <div class="register">
              <a href="./log.register.php"> Non hai ancora un account? Registrati </a>
            </div>

        </div>

    </form>

    <script src="./js/log.js"></script>

  </body>

</html>
