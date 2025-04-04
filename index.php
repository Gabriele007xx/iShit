<?php
session_start();
require('config/config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iShit - La tua cacca online</title>
</head>
<body>
    <h1>Ultimi post</h1>
    <?php
    try {
        $stmt = $pdo->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT 10");
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($posts) {
            foreach ($posts as $post) {
                echo "<img src='" . htmlspecialchars($post['fileNome']) . "' alt='Post Image' style='width: 100px; height: 100px;'>";
                echo "<span style='color: " . htmlspecialchars($post['color']) . ";'>" . htmlspecialchars($post['color']) . "Galleggia:" . htmlspecialchars($post['galleggio']) ."Forma:" . htmlspecialchars($post['forma']) . "</span>";
                echo "<small>Pubblicato il " . htmlspecialchars($post['data']) . "</small><hr>";
                echo "<hr>";
            }
        } else {
            echo "<p>Nessun post trovato.</p>";
        }
    } catch (PDOException $e) {
        echo "Errore: " . $e->getMessage();
    }
    ?>
</body>
</html>