<!DOCTYPE html>

  <?php
    include 'dbConfig.php';
  ?>

<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> Registrazione </title>

    <link rel="icon" href="./immagini/logo_small_icon.png">
    <link rel="stylesheet" href="./css/style.log.css">
    <link rel="stylesheet" href="./css/background.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body>

    <div class="background"></div>

      <form class="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

          <div class="box-shadow" id=box>
              <div class="title"> <h1> Registrati </h1> </div>

            <hr>

              <div class="box-log-container">
                <input type="text" class="data" maxlength="30" placeholder="Nome" name="nome" required>
                <input type="text" class="data" maxlength="30" placeholder="Cognome" name="cognome" required>
                <input type="text" class="data" maxlength="50" placeholder="Email" name="email" required pattern = "[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                <input type="text" class="data" maxlength="30" placeholder="Username" name="username" required>
                <input type="password" class="data" minlength="8" maxlength="30" placeholder="Password (min 8 car., no spazi)" name="password" id="MyPass" required pattern="[^' ']+">
                <input type="password" class="data" minlength="8" maxlength="30" placeholder="Ripeti Password" name="Rpassword" id="MyPass2" required pattern="[^' ']+">
                <div class="show-pass">
                  <input type="checkbox" onclick="showPass()"> Show Password
                </div>
                <input type="submit" class="singin" value="Registrati" name="registrati">

                <?php
                  if(isset($_POST["registrati"])) {

                    //acquisizione dati dal form
                    $nome = $_POST["nome"];
                    $cognome = $_POST["cognome"];
                    $email = strtolower($_POST["email"]);
                    $username = strtolower($_POST["username"]);
                    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                    $Rpassword = $_POST["Rpassword"];

                    $sql = "INSERT into utenti (nome, cognome, email, username, password) VALUES ('$nome', '$cognome', '$email', '$username', '$password')";

                    if ($_POST["password"] == $Rpassword)
                    {
                        if($conn->query($sql))
                        {
                          header('location: ./log.php');
                        }
                        else
                        {
                          echo "<p class=errore> Errore nell'inserimento, riprovare: <br>" . $conn->error . "</p>";
                        }
                    }
                    else
                    {
                      echo "<p class=errore> Controlla di aver inserito correttamente la password <br>" . $conn->error . "</p>";
                    }
                  }
                ?>

              </div>

            <hr>

              <div class="register">
                <a href="./log.php"> Hai già un'account? Accedi </a>
              </div>
          </div>

      </form>

    <script src="./js/log.js"></script>

  </body>

</html>
