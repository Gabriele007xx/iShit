<?php

if(isset($_GET['step']) && $_GET['step'] == 1) {
    if(isset($_POST['invio']))
{
    $db_host = $_POST['db_host'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];

    // Create database connection
    $pdo=new PDO("mysql:host=$db_host", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        if(file_exists('../config/config.php'))
        {
                $error="Il file di configurazione esiste già. Se si desidera reinstallare, eliminare il file config.php e riprovare.";
        }
        else
        {
            $config = "<?php\n";
            $config .= "// Database configuration\n";
            $config .= "define('DB_HOST', '$db_host');\n";
            $config .= "define('DB_NAME', 'ishit');\n";
            $config .= "define('DB_USER', '$db_user');\n";
            $config .= "define('DB_PASS', '$db_pass');\n";
            $config .= "try {\n";
            $config .= "// Create a new PDO instance\n";
            $config .= "\$pdo = new PDO(\"mysql:host=\" . DB_HOST . \";dbname=\" . DB_NAME, DB_USER, DB_PASS);\n";
            $config .= "// Set the PDO error mode to exception\n";
            $config  .= "\$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);\n";
            $config .= "} catch (PDOException \$e) {\n";
            $config .= "// Handle connection error\n";
            $config .= "die(\"Database connection failed: \" . \$e->getMessage());\n";
            $config .="}";
            file_put_contents('../config/config.php', $config);
            $success="File di configurazione creato con successo!";
        }

        // Create database
        $sql = "CREATE DATABASE IF NOT EXISTS ishit";
        $pdo->exec($sql);

        // Create tables and insert initial data here if needed

        $success="Database 'ishit' creato!";
        header("Location: install.php?step=2");
    } catch (PDOException $e) {
        $error= "Errore di connessione al database: " . $e->getMessage();
    }
}
}
else
{
    if(isset($_POST['step']) && $_POST['step'] == 2)
    {
    $queryVotes="CREATE TABLE `votes` (
  `idPost` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `reaction` int(11) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    COMMIT";

    $queryUser="CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

$queryPrimaryKeyUser="ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);";

$queryAIKeyUser="ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;";

    $queryPosts="CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `color` varchar(10) NOT NULL,
  `galleggio` varchar(4) NOT NULL,
  `forma` varchar(10) NOT NULL,
  `fileNome` varchar(40) NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `votes` int(11) NOT NULL,
  `comments` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

$queryPrimaryKeyPosts="ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);";

  $queryAIKeyPosts="ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;";

    $queryComments="CREATE TABLE `comments` (
  `idUser` int(11) NOT NULL,
  `idPost` int(11) NOT NULL,
  `comment` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
COMMIT;";
try
{
    $pdo = new PDO("mysql:host=" . $_POST['db_host'] . ";dbname=ishit" , $_POST['db_user'], $_POST['db_pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt=$pdo->prepare($queryVotes);
    $stmt->execute();
    $stmt=$pdo->prepare($queryUser);
    $stmt->execute();
    $stmt=$pdo->prepare($queryPrimaryKeyUser);
    $stmt->execute();
    $stmt=$pdo->prepare($queryAIKeyUser);
    $stmt->execute();
    $stmt=$pdo->prepare($queryPosts);
    $stmt->execute();
    $stmt=$pdo->prepare($queryPrimaryKeyPosts);
    $stmt->execute();
    $stmt=$pdo->prepare($queryAIKeyPosts);
    $stmt->execute();
    $stmt=$pdo->prepare($queryComments);
    $stmt->execute();
    $success="Tabelle create!";
}
catch(PDOException $e)
{
    $error="Errore di connessione al database: " . $e->getMessage();
}
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Installazione - iShit</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
        <?php if(isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <?php if(isset($success)): ?>
            <div class="success"><?php echo $success; ?></div>
        <?php endif; ?>
        <section>
            <h1>Benvenuto nel programma di installazione di iShit!</h1>
            <p>In questa pagina potete installare iShit. Se lo si è già installato, eliminare questa cartella, in quanto risulta eseguibile a chiunque.</p>

            <?php
                if(isset($_GET['step']) && $_GET['step'] == 2) {
                    echo "<h2>Passo 2: Creazione tabelle";
                    echo "<form method='POST'>
                    <input type='hidden' name='db_host' value='$_GET[db_host]'>
                    <input type='hidden' name='db_user' value='$_GET[db_user]'>
                    <input type='hidden' name='db_pass' value='$_GET[db_pass]'>
                        <input type='hidden' value=2 name='step'>
                        <input type='submit' name='invio' value='Crea tabelle'>";
                } else {
                
                    echo " <h2>Passo 1: database</h2>
            <form method='GET'>
                <label for='db_host'>Host del database:</label>
                <input type='text' name='db_host' id='db_host' value='localhost' required><br>
                <label for='db_user'>Utente del database:</label>
                <input type='text' name='db_user' id='db_user'><br>
                <label for='db_pass'>Password del database:</label>
                <input type='password' name='db_pass' id='db_pass'><br>
                <input type='hidden' name='step' value=2>
                <input type='submit' name='invio' value='Installa'>
            </form>";
                
                }
            ?>
           
        </section>
    </main>
</body>
</html>