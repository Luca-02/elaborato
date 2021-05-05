<?php
  session_start();
  if (!isset($_SESSION['email'])) {
    header("Location: ./log.php");
  }

  include './dbConfig/dbConfig.php';

  $email = $_SESSION['email'];
  $sql_user = "SELECT * FROM $utenti WHERE email = '$email'";
               $result_user = $conn->query($sql_user);
               $row_user = $result_user->fetch_assoc();
               $IDutente = $row_user["IDutente"];

    $IDprodotto_taglia = $_POST["btn-rimuovi-carrello"];

    $sql_delete = "DELETE FROM $carrello WHERE idprodotto_taglia = $IDprodotto_taglia AND idutente = $IDutente";

    if ($conn->query($sql_delete)) {
      header("Location: ./carrello.php");
    }
    else {
      echo "Error deleting record: " . $conn->error;
    }
?>
