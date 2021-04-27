<!DOCTYPE html>
<html>

<?php
  include 'dbConfig.php';

  $sql2 = "SELECT * FROM $prodotto";
           $result2 = $conn->query($sql2);
 ?>

  <head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Insert img </title>

  </head>

  <body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        Select Image File to Upload:
        <input type="file" name="file">
        <br><br>
        Seleziona l'ID del prodotto dell'immagine da caricare
        <select name="IDprodotto" required>
          <option value="" selected disabled> Seleziona prodotto </option>
          <?php
              while($row2 = $result2->fetch_assoc()) {
                echo "
                <option value={$row2['IDprodotto']}> {$row2['IDprodotto']} - {$row2['titolo']} </option>
                ";
              }
           ?>
        </select>
        <br>
        <input type="submit" name="submit" value="Upload">
    </form>
  </body>

</html>
