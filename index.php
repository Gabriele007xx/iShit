<?php
session_start();
require('config/config.php');
require('utils/functions.php');
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
    <?php include('./site/nav.php'); ?>
    <h1>Ultimi post</h1>
    <?php
    try {
        $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($posts) {
            foreach ($posts as $post) {
                echo "<section><img src='" . htmlspecialchars($post['fileNome']) . "' alt='Post Image' style='width: 100px; height: 100px;'>";
                echo "<span style='color: " . getColorByColor($post['color']) . ";'><img src=./" . getShitImage($post['color']) . ">" . htmlspecialchars($post['color']) . " Galleggia:" . htmlspecialchars($post['galleggio']) ." Forma:" . htmlspecialchars($post['forma']) . "</span>";
                echo "<small>Pubblicato il " . htmlspecialchars($post['data']) . "</small>";
                echo "</section>";
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