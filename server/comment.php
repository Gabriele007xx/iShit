<?php
if(!isset($_SESSION['id']))
{
    header("Location: ../index.php?error=notLoggedIn");
    exit;
}
if($_POST["id"] != $_SESSION['id'])
{
    header("Location: ../index.php?error=notYourID");
    exit;
}
if($_POST["comment"] == "")
{
    header("Location: ../index.php?error=emptyComment");
    exit;
}
require('../config/config.php');
require('../utils/functions.php');

$query="INSERT INTO comments (idPost, idUser, comment) VALUES (:idPost, :idUser, :comment)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':idPost', $_GET['id']);
$stmt->bindParam(':idUser', $_SESSION['id']);
$stmt->bindParam(':comment', $_GET['comment']);
if($stmt->execute())
{
    $incrementComments="UPDATE posts SET comments = comments + 1 WHERE idPost=:idPost";
    $stmt = $pdo->prepare($incrementComments);
    $stmt->bindParam(':idPost', $_GET['id']);
    if($stmt->execute())
    {
        header("Location: ../index.php?success=commentAdded");
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