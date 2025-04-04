<?php
session_start();

require('../config/config.php');

if(isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
}

if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $user['id'];
            header('Location: ../index.php');
            exit();
        } else {
            $message = "Nome utente o password errati!";
        }
    } catch (PDOException $e) {
        $message = "Errore: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - iShit</title>
</head>
<body>
    <?php include('../site/nav.php'); ?>
    <h1>Login</h1>
    <?php if(isset($message)): echo $message; endif; ?>
    <form method="POST" action="">
        <label for="username">Nome utente:</label>
        <input type="text" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" name="login" value="Accedi">
    </form>
    <p>Non hai un account? <a href="../register/">Registrati</a></p>
    <?php include('../site/footer.php'); ?>
</body>
</html>