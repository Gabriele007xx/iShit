<?php
session_start();

require('../config/config.php');

if(isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

if(isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            //check if username already exists
            $found=false;
            $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
            if($stmt->execute([':username' => $username])) {
                if($stmt->rowCount() > 0) {
                    $message = "Nome utente già esistente!";
                    $found=true;
                }
            }
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashed_password);
            $stmt->execute();
            $message= "Registrazione avvenuta con successo!";
        } catch (PDOException $e) {
            $message= "Errore: " . $e->getMessage();
        }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati - iShit</title>
</head>
<body>
    <?php include('../site/nav.php'); ?>
    <?php if(isset($message)) { echo "<p>$message</p>"; } ?>
    <h1>Registrati</h1>
    <form method="POST" action="">
        <label for="username">Nome utente:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="register" value="Registrati">
    </form>
    <?php include('../site/footer.php'); ?>
</body>
</html>