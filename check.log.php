<?php

  include './dbConfig/dbConfig.php';
  include './dbConfig/dbConfig_dip.php';

  if (isset($_POST["accedi"]))
  {

      //acquisizione dati dal form HTML
      $_email = strtolower($_POST["email"]);
      $email = mysqli_real_escape_string($conn, $_email);
      $password = mysqli_real_escape_string($conn, $_POST['password']);

      //lettura della tabella utenti
      $controllo = false;
      $controllo2 = false;
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
        $result2 = $conn2->query($sql2);
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
        header("Location: ./log.fail.php");
      }

  }

?>
