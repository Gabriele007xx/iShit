<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: ../login/index.php');
    exit();
}
require('../config/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your account - iShit</title>
</head>
<body>
    <?php include('../site/nav.php'); ?>
    <h1>Dettagli account</h1>
    <table>
        <tr>
            <th>Nome utente</th>
            <td><?php echo htmlspecialchars($_SESSION['username']); ?></td>
        </tr>
    </table>
    <h2>Tutti i tuoi post</h2>
    <a href="../newpost/">Crea un nuovo post...</a>
    <?php
        $query="SELECT * FROM posts WHERE username = :username ORDER BY id DESC";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $_SESSION['username']);
        $stmt->execute();
        $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($posts) {
            foreach ($posts as $post) {
                echo "<img src='../uploads/" . htmlspecialchars($_SESSION['username']) . "/" . htmlspecialchars($post['fileNome']) . "' alt='Post Image' style='width: 100px; height: 100px;'>";
                echo "<span style='color: " . htmlspecialchars($post['color']) . ";'>" . htmlspecialchars($post['color']) . "Galleggia:" . htmlspecialchars($post['galleggio']) ."Forma:" . htmlspecialchars($post['forma']) . "</span>";
                echo "<small>Pubblicato il " . htmlspecialchars($post['data']) . "</small><hr>";
                echo "<hr>";
            }
        } else {
            echo "<p>Nessun post trovato.</p>";
        }
    ?>
    <?php include('../site/footer.php'); ?>
</body>
</html>