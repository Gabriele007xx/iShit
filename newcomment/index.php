<?php
//unused
session_start();
if(!isset($_SESSION['id'])) {
    header("Location: ../index.php?error=notLoggedIn");
    exit;
}
require('../config/config.php');
require('../utils/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuovo commento - iShit</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php include('../site/nav.php'); ?>
    <main>
    <h1>Nuovo commento</h1>
    <form action="../server/comment.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        <textarea name="comment" rows="4" cols="50" required></textarea><br>
        <input type="submit" value="Aggiungi commento">
    </form>
    </main>
    <?php include('../site/footer.php'); ?>
</body>
</html>