<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: ../login/index.php');
    exit();
}
require('../config/config.php');
include('../site/nav.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Account - iShit</title>
</head>
<body>
    <?php 
    navbar(1)
    ?>
    <main>
    <h1>Dettagli account</h1>
    <table>
        <tr>
            <th><img src="../res/avatar.png"></th>
            <th>Nome utente</th>
            <td><?php echo htmlspecialchars($_SESSION['username']); ?></td>
            <td><img src="../res/settings"><a href="./settings">Impostazioni</a></td>
        </tr>
    </table>
    <h2>Tutti i tuoi post</h2>
    <section><img src="../res/newpost.png"><a href="../newpost/">Crea un nuovo post...</a></section>
    <?php
        $query="SELECT * FROM posts WHERE username = :username ORDER BY id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $_SESSION['username']);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            foreach ($posts as $post) {
                printPost($post['fileNome'], $post['color'], $post['galleggio'], $post['data'], $post['forma'], $post['id'],$post['votes'], 1);
            }
        } else {
            echo "<p>Nessun post trovato.</p>";
        }
    ?>
    <?php include('../site/footer.php'); ?>
    </main>
</body>
</html>