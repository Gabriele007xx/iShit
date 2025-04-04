<?php
    require('../config/config.php');
    require('../utils/functions.php');
    include('../site/nav.php'); 
    $query = "SELECT * FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$post) {
        $message= "Post non trovato.";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Cacca di - <?php $post["username"]?> iShit</title>
</head>
<body>
    <main>
    <?php 
        navbar(1);
    ?>
    <?php
        if(isset($message)){
            echo "<p>$message</p>";
        } else {
            printPost($post['fileNome'], $post['color'], $post['galleggio'], $post['data'], $post['forma'], $post['id'], $post['votes'], 1);
        }
    ?>
    <?php include('../site/footer.php'); ?>
    </main>
</body>
</html>