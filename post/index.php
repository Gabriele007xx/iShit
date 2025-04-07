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
    <section>
        <form method="POST" action="../server/comment.php">
            <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
            <textarea name="comment" rows="4" cols="50" required></textarea><br>
            <input type="submit" value="Aggiungi commento">
        </form>
    </section>
    <?php
        $query = "SELECT * FROM comments WHERE idPost = :idPost";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':idPost', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        while ($comment = $stmt->fetch(PDO::FETCH_ASSOC)) {
            printComment($comment['comment'], $comment['idUser'], 1);
        }
    ?>
    <?php include('../site/footer.php'); ?>
    </main>
</body>
</html>