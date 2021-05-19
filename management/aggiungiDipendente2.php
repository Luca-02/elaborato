<?php
  session_start();
  if (!isset($_SESSION['email_aziendale'])) {
    header("Location: ../log.php");
  }

  include '../dbConfig/dbConfig_dip.php';

  if (isset($_POST["conferma"])) {

    $nome = mysqli_real_escape_string($conn2, $_POST['nome']);
    $cognome = mysqli_real_escape_string($conn2, $_POST['cognome']);
    $dataN = mysqli_real_escape_string($conn2, $_POST['dataN']);
    $luogoN = mysqli_real_escape_string($conn2, $_POST['luogoN']);
    $siglaP = mysqli_real_escape_string($conn2, $_POST['siglaP']);
    $codiceF = mysqli_real_escape_string($conn2, $_POST['codiceF']);
    $sesso = mysqli_real_escape_string($conn2, $_POST['sesso']);
    $salario = mysqli_real_escape_string($conn2, $_POST['salario']);
    $oreL = mysqli_real_escape_string($conn2, $_POST['oreL']);
    $mailP = mysqli_real_escape_string($conn2, $_POST['mailP']);
    $mailA = mysqli_real_escape_string($conn2, $_POST['mailA']);
    $passwordA = mysqli_real_escape_string($conn2, $_POST['passwordA']);
    $mansione = mysqli_real_escape_string($conn2, $_POST['mansione']);

    $orarioI_1 = mysqli_real_escape_string($conn2, $_POST['orarioI_1']);
    $orarioI_2 = mysqli_real_escape_string($conn2, $_POST['orarioI_2']);
    $orarioI_3 = mysqli_real_escape_string($conn2, $_POST['orarioI_3']);
    $orarioI_4 = mysqli_real_escape_string($conn2, $_POST['orarioI_4']);
    $orarioI_5 = mysqli_real_escape_string($conn2, $_POST['orarioI_5']);
    $orarioI_6 = mysqli_real_escape_string($conn2, $_POST['orarioI_6']);
    $orarioI_7 = mysqli_real_escape_string($conn2, $_POST['orarioI_7']);

    $orarioF_1 = mysqli_real_escape_string($conn2, $_POST['orarioF_1']);
    $orarioF_2 = mysqli_real_escape_string($conn2, $_POST['orarioF_2']);
    $orarioF_3 = mysqli_real_escape_string($conn2, $_POST['orarioF_3']);
    $orarioF_4 = mysqli_real_escape_string($conn2, $_POST['orarioF_4']);
    $orarioF_5 = mysqli_real_escape_string($conn2, $_POST['orarioF_5']);
    $orarioF_6 = mysqli_real_escape_string($conn2, $_POST['orarioF_6']);
    $orarioF_7 = mysqli_real_escape_string($conn2, $_POST['orarioF_7']);

    $sql_max = "SELECT MAX(IDdipendente) as max FROM dipendenti";
                $result_max = $conn2->query($sql_max);
                $row_max = $result_max->fetch_assoc();
                $IDmax = $row_max["max"];

    $ID_dip = $IDmax + 1;

    $sql = "INSERT INTO dipendenti (IDdipendente, nome, cognome, data_nascita, luogo_nascita, sesso,
            provincia_sigla, codice_fiscale, salario_mensile, ore_lavoro_settimanali, email_personale,
            email_aziendale, password_aziendale, idmansione)
            VALUES ('$ID_dip', '$nome', '$cognome', '$dataN', '$luogoN', '$sesso', '$siglaP', '$codiceF', '$salario',
            '$oreL', '$mailP', '$mailA', '$passwordA', '$mansione')";

    if ($conn2->query($sql))
    {
      $sql2 = "INSERT INTO orari_lavorativi (orario_inizio, orario_fine, idgiorno, iddipendente)
               VALUES
               ('$orarioI_1', '$orarioF_1', '1', '$ID_dip'),
               ('$orarioI_2', '$orarioF_2', '2', '$ID_dip'),
               ('$orarioI_3', '$orarioF_3', '3', '$ID_dip'),
               ('$orarioI_4', '$orarioF_4', '4', '$ID_dip'),
               ('$orarioI_5', '$orarioF_5', '5', '$ID_dip'),
               ('$orarioI_6', '$orarioF_6', '6', '$ID_dip'),
               ('$orarioI_7', '$orarioF_7', '7', '$ID_dip')";

       if ($conn2->query($sql2))
       {
         echo "dipendente aggiunto (<a href=./managementPage.php> torna alla home </a>)";
       }
       else
       {
         echo "Error: " . $sql2 . "<br>" . $conn2->error;
       }
    }
    else
    {
      echo "Error: " . $sql . "<br>" . $conn2->error;
    }

  }



?>
