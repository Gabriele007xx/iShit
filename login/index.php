<?php
session_start();

require('../config/config.php');

if(isset($_SESSION['username'])) {
    header('Location: ../index.php');
    exit();
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
    
</body>
</html>