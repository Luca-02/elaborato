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

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

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

              <?php

                if (isset($_POST["accedi"]))
                {

                    //acquisizione dati dal form HTML
                    $_email = strtolower($_POST["email"]);
                    $email = mysqli_real_escape_string($conn, $_email);
                    $password = mysqli_real_escape_string($conn, $_POST['password']);

                    //lettura della tabella utenti
                    $controllo = false;
                    $sql = "SELECT * FROM $utenti WHERE email = '$email'";
                    $result = $conn->query($sql);
                    $conta = $result->num_rows;


                    if ($conta == 1)
                    {
                      $row = $result->fetch_assoc();
                      $passc = $row['password'];
                        if (password_verify($password, $passc))
                        {
                          $controllo = true;
                        }
                    }
                    else
                    {
                      $sql2 = "SELECT * FROM $dipendenti WHERE email_aziendale = '$email'";
                      $result2 = $conn->query($sql2);
                      $conta2 = $result2->num_rows;

                        if ($conta2 == 1)
                        {
                          $row2 = $result2->fetch_assoc();
                          $passc2 = $row2['password_aziendale'];
                          if ($password == $passc2)
                          {
                            $controllo2 = true;
                          }
                        }
                    }


                    if ($controllo)
                    {
                      session_start();
                      $_SESSION['email'] = $email;
                      $_SESSION['password'] = $passc;
                      header("Location: ./mainPageLogin.php");
                    }
                    else if ($controllo2)
                    {
                      session_start();
                      $_SESSION['email_aziendale'] = $email;
                      $_SESSION['password_aziendale'] = $passc2;
                      header("Location: ./management/managementPage.php");
                    }
                    else
                    {
                      echo "<p class=errore> Identificazione non riuscita: email o password errate, riprovare </p>";
                    }

                }

              ?>

            </div>
          <hr>
            <div class="register">
              <a href="./log.register.php"> Non hai ancora un account? Registrati </a>
            </div>

        </div>

    </form>

    <script src="./js/log.js"></script>

  </body>

</html>
