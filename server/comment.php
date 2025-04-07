<?php
session_start();
if(!isset($_SESSION['id']))
{
    header("Location: ../index.php?error=notLoggedIn");
    exit;
}
if($_POST["comment"] == "")
{
    header("Location: ../index.php?error=emptyComment");
    exit;
}
require('../config/config.php');
require('../utils/functions.php');

$query="INSERT INTO comments (idUser, idPost, comment) VALUES (:idUser, :idPost, :comment)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idPost', $_POST['idPost']);
$stmt->bindParam(':idUser', $_SESSION['id']);
$stmt->bindParam(':comment', $_POST['comment']);
if($stmt->execute())
{
    $incrementComments="UPDATE posts SET comments = comments + 1 WHERE id=:id";
    $stmt = $pdo->prepare($incrementComments);
    $stmt->bindParam(':id', $_POST['id']);
    if($stmt->execute())
    {
        header("Location: ../index.php?success=commentAdded?id=".$_POST['idPost']);
        exit;
    }
    else
    {
        header("Location: ../index.php?error=commentNotAdded");
        exit;
    }
}
else
{
    header("Location: ../index.php?error=commentNotAdded");
    exit;
}
?>