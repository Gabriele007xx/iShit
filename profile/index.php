<?php
require('../config/config.php');
require('../utils/functions.php');

if(isset($_SESSION['id']) && $_SESSION['id'] == $_GET['id'])
{
    header('Location: ../account/index.php');
    exit();
}
$stmt=$pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
if($stmt->rowCount() == 0)
{
    $error="Utente non trovato";
    $user['username'] = "?";
}
else
{
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo di <?php echo $user['username']; ?>- iShit</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include('../site/nav.php'); 
    navbar(1);
    ?>
    <main>
        <section>
        <?php
        if(isset($error))
        {
            echo "<h2 class='error'>" . htmlspecialchars($error) . "</h2>";
        }
        else
        {
            ?>
            <table class="table-menu">
                <tr>
                    <th><img src="../res/avatar.png"></th>
                    <th>Nome utente</th>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                </tr>
                <?php
        }
        ?>
            </table>
        </section>
        <section>
            <h2>Posts</h2>
        </section>    
            <?php 
            $query="SELECT * FROM posts WHERE userID = :userID ORDER BY id DESC";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userID', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($posts) {
                foreach ($posts as $post) {
                    ?> <section> <?php
                    printPost($post['fileNome'], $post['color'], $post['galleggio'], $post['data'], $post['forma'], $post['id'],$post['votes'], 1);
                    ?> </section> <?php
                }
            } else {
                echo "<p>Nessun post trovato.</p>";
            }
            ?>
        
    </main>
    <?php include('../site/footer.php'); ?>
</body>
</html>