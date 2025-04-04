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
                echo "<h2>" . htmlspecialchars($post['title']) . "</h2>";
                echo "<p>" . htmlspecialchars($post['content']) . "</p>";
                echo "<small>Pubblicato il " . htmlspecialchars($post['created_at']) . "</small><hr>";
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