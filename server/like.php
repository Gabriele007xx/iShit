<?php
session_start();
if(!isset($_SESSION['id']))
{
    header("Location: ../index.php?error=notLoggedIn");
    exit;
}
require('../config/config.php');
require('../utils/functions.php');
$verifyVote="SELECT * FROM votes WHERE idPost=:idPost AND idUser=:idUser";
$stmt = $pdo->prepare($verifyVote);
$stmt->bindParam(':idPost', $_GET['id']);
$stmt->bindParam(':idUser', $_SESSION['id']);
$stmt->execute();
$vote = $stmt->fetch(PDO::FETCH_ASSOC);
if($stmt->rowCount() > 0)
{
    header("Location: ../index.php?error=alreadyVoted");
    exit;
}
else
{
    $insertVote="INSERT INTO votes (idPost, idUser, reaction) VALUES (:idPost, :idUser, :reaction)";
    $stmt = $pdo->prepare($insertVote);
    $stmt->bindParam(':idPost', $_GET['id']);
    $stmt->bindParam(':idUser', $_SESSION['id']);
    $stmt->bindParam(':reaction', $_GET['reaction']);
    if($stmt->execute())
    {
        $incrementVotes="UPDATE posts SET votes = votes + 1 WHERE id=:id";
        $stmt = $pdo->prepare($incrementVotes);
        $stmt->bindParam(':id', $_GET['id']);
        if($stmt->execute())
        {
            header("Location: ../index.php?success=voteAdded");
            exit;
        }
        else
        {
            header("Location: ../index.php?error=voteNotAdded");
            exit;
        }
    }
    else
    {
        header("Location: ../index.php?error=voteNotAdded");
        exit;
    }
}

?>