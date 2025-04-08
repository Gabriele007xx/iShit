<?php
session_start();
if(!isset($_SESSION['username'])) {
    header('Location: ../login/index.php');
    exit();
}
require('../../config/config.php');
if(isset($_POST['update']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    
    // Validate input
    if(empty($username) || empty($email)) {
        $error="Riempire tutti i campi";
    }
    else
    {
        try
        {
            // Update user information in the database
            $query = "UPDATE users SET username = :username, email = :email WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $_SESSION['id']);
            $stmt->execute();
            $success="Informazioni aggiornate con successo";
        }
        catch(PDOException $e)
        {
            $error="Errore durante l'aggiornamento delle informazioni: " . $e->getMessage();
        }
    }
}
$user="SELECT * FROM users WHERE id = :id";
$stmt = $pdo->prepare($user);
$stmt->bindParam(':id', $_SESSION['id']);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Impostazioni - iShit</title>
    <link rel="stylesheet" href="../../style.css">
</head>
<body>
   <?php 
   include('../../site/nav.php');
   navbar(2);
   ?>
   <?php if(isset($error)): ?>
       <p class="error"><?php echo htmlspecialchars($error); ?></p>
   <?php endif; ?>
    <?php if(isset($success)): ?>
         <p class="success"><?php echo htmlspecialchars($success); ?></p>   
    <?php endif; ?>     
   <section class="settings">
       <h1>Impostazioni account</h1>
       <form method="POST">
           <label for="username">Nome utente:</label>
           <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
           <label for="email">Email:</label>
           <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
           <button type="submit" name="update">Aggiorna</button>
       </form>
</body>
</html>