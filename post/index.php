<?php
    require('../config/config.php');
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
    <title>Cacca di - <?php $post["username"]?> iShit</title>
</head>
<body>
    <?php
        if(isset($message)){
            echo "<p>$message</p>";
        } else {
            echo "<img src='" . htmlspecialchars($post['fileNome']) . "' alt='Post Image' style='width: 100px; height: 100px;'>";
            echo "<span style='color: " . htmlspecialchars($post['color']) . ";'>" . htmlspecialchars($post['color']) . "Galleggia:" . htmlspecialchars($post['galleggio']) ."Forma:" . htmlspecialchars($post['forma']) . "</span>";
            echo "<small>Pubblicato il " . htmlspecialchars($post['data']) . "</small><hr>";
        }
    ?>
</body>
</html>