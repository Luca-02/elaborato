<?php
  session_start();
  if (!isset($_SESSION['email_aziendale'])) {
    header("Location: ../log.php");
  }

  include '../dbConfig/dbConfig.php';

  $statusMsg = '';

  // File upload path
  $targetDir = "../uploads/";
  $fileName = basename($_FILES["file"]["name"]);
  $targetFilePath = $targetDir . $fileName;
  $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

  if(isset($_POST["submit"]) && !empty($_FILES["file"]["name"])){
      $ID_p = $_POST['submit'];

      $allowTypes = array('jpg','png','jpeg','gif','pdf');
      if(in_array($fileType, $allowTypes)){

          if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){

              $insert = $conn->query("INSERT into immagine_prodotto (file_name) VALUES ('".$fileName."')");
              if($insert){
                  $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                  $sql = "SELECT * FROM $immagine_prodotto WHERE file_name = '".$fileName."'";
                  $result = $conn->query($sql);
                  $row = $result->fetch_assoc();
                  $ID_imgP = $row['IDimmagine_prodotto'];
                  $sql2 = "UPDATE $prodotto SET idimmagine_prodotto = $ID_imgP WHERE $prodotto.IDprodotto = $ID_p";
                    if ($conn->query($sql2) === TRUE) {
                      echo "Record updated successfully";
                      echo "<a href=./aggiungiProdotto.php> Ritorna alla home </a>";
                    } else {
                      echo "Error updating record: " . $conn->error;
                    }
              }else{
                  $statusMsg = "File upload failed, please try again.";
              }
          }
          else{
              $statusMsg = "Sorry, there was an error uploading your file.";
          }

      }
      else{
          $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
      }
  }else{
      $statusMsg = 'Please select a file to upload.';
  }
  echo $statusMsg;
?>
