<?php
session_start();
require('../config/config.php');
require('../utils/functions.php');
include('../site/nav.php'); 
if(!isset($_SESSION['username'])) {
    header('Location: ../login/');
    exit();
}
if(isset($_POST['submit'])) {
    $color = $_POST['color'];
    $galleggio = $_POST['galleggio'];
    $forma = $_POST['forma'];
    $fileToUpload = $_FILES['fileToUpload']['name'];
    
    // Check if file is uploaded
    if (isset($_FILES['fileToUpload']) && $_FILES['fileToUpload']['error'] == 0) 
    {

        $target_dir = "../uploads/" . $_SESSION['username'] . "/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if(checkFileType($imageFileType) == false) 
        {
            $message= "Il file non è un'immagine.";
            exit();
        }
        //reasign the file to a random name
        $target_file = $target_dir . randomString(32) . $_FILES["fileToUpload"]["name"];
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    } else {
        $message= "Errore nel caricamento del file.";
    }

    try 
    {
        $stmt = $pdo->prepare("INSERT INTO posts (userID, color, galleggio, forma, fileNome) VALUES (:userid, :color, :galleggio, :forma, :nomefile)");
        $stmt->bindParam(':userid', $_SESSION['id']);
        $stmt->bindParam(':color', $color);
        $stmt->bindParam(':float', $float);
        $stmt->bindParam(':forma', $forma);
        $stmt->bindParam(':nomefile', pathinfo($target_file,PATHINFO_FILENAME));
        $stmt->execute();
        $message= "Post pubblicato con successo!";
    } catch (PDOException $e) {
        $message= "Errore: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Nuovo Post - iShit</title>
</head>
<body>
    <main>
    <?php 
        navbar(1);
    ?>
    <?php if(isset($message)) { echo "<p>$message</p>"; } ?>
    <h1>Nuovo Post</h1>
    <form method="POST" action="" enctype="multipart/form-data">
        <label for="color">Colore:</label>
        <input type="radio" name="color" value="marrone" required> <label>Marrone</label>
        <input type="radio" name="color" value="verde" required> <label>Verde</label>
        <input type="radio" name="color" value="rossa" required> <label>Rosso</label>
        <label for="content">Gallegiava?</label><br>
        <input type="radio" name="galleggio" value="yes" required><label> Si</label>
        <input type="radio" name="galleggio" value="no" required> <label>No</label><br>
        <label for="forma">Forma:</label><br>  
        <input type="radio" name="forma" value="liquida" required> <label>Liquida</label>
        <input type="radio" name="forma" value="solida" required> <label>Solida</label><br>
        <input type="radio" name="forma" value="semiliquida" required> <label>Semi-liquida</label>
        <label>Foto:</label><br>
        <input type="file" name="fileToUpload" id="fileToUpload"><br>
        <input type="submit" name="submit" value="Pubblica">
    </form>
    <?php include('../site/footer.php'); ?> 
    </main>   
</body>
</html>