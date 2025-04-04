<?php
session_start();
require('config/config.php');
require('utils/functions.php');
include('./site/nav.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>iShit - La tua cacca online</title>
</head>
<body>
    <main>
    <?php 
    navbar(0);
    if(isset($_GET['error'])) {
        echo "<p class='error'>Errore: " . htmlspecialchars($_GET['error']) . "</p>";
    }
    ?>
    <h1>Ultimi post</h1>
    <?php
    try {
        $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($posts) {
            foreach ($posts as $post) {
                printPost($post['fileNome'], $post['color'], $post['galleggio'], $post['data'], $post['forma'], $post['id'], $post['votes'], 0);
            }
        } else {
            echo "<p>Nessun post trovato.</p>";
        }
    } catch (PDOException $e) {
        echo "Errore: " . $e->getMessage();
    }
    ?>
    <?php include('./site/footer.php'); ?>  
    </main>  
</body>
</html>