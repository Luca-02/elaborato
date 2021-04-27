<?php
  // Include the database configuration file
  include 'dbConfig.php';

  // Get images from the database
  $query = $conn->query("SELECT * FROM $immagine_prodotto");

  if($query->num_rows > 0){
      while($row = $query->fetch_assoc()){
          $imageURL = 'uploads/'.$row["file_name"];
?>

    <img src="<?php echo $imageURL; ?>" width="500" />

<?php }
  }
  else {
?>
    <p>No image(s) found...</p>
<?php
  }
?>
