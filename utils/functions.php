<?php
define('DEFAULT_IMAGE_PATH', 'res/icon');

function randomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function checkFileType($extension) {
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    return in_array($extension, $allowedTypes);
}

function getColorByColor($color)
{
    switch($color) {
        case 'marrone':
            return '#8B4513';
        case 'verde':
            return '#008000'; 
        case 'rossa':
            return '#FF0000'; 
        default:
            return '#000000'; 
    }
}

function getShitImage($color)
{
    switch($color) {
        case 'marrone':
            return DEFAULT_IMAGE_PATH . '/brownshit.png'; 
        case 'verde':
            return DEFAULT_IMAGE_PATH . '/greenshit.png'; 
        case 'rossa':
            return DEFAULT_IMAGE_PATH . '/redshit.png'; 
        default:
            return DEFAULT_IMAGE_PATH . '/brownshit.png';
    }
}

function printPost($fileNome, $color, $galleggio, $data, $forma, $id, $votes, $level)
{
    global $pdo;
    $query = "SELECT * FROM comments WHERE idPost = :idPost";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idPost', $id, PDO::PARAM_INT);
    $stmt->execute();
    echo "<section><img src='" . buildPath($level) . htmlspecialchars($fileNome) . "' alt='Post Image' style='width: 100px; height: 100px;'>";
    echo "<span style='color: " . getColorByColor($color) . ";'><img src=" . buildPath($level) . getShitImage($color) . ">" . htmlspecialchars($color) . " Galleggia:" . htmlspecialchars($galleggio) ." Forma:" . htmlspecialchars($forma) . "</span>";
    echo "<small>Pubblicato il " . htmlspecialchars($data) . " <a href='" . buildPath($level) . "post/index.php?id=" . $id . "'>Vedi post</a> Mi piace: " . $votes . "<a href='" . buildPath($level) . "/server/like.php?id=" . $id . "&reaction=1'><img src='" . buildPath($level) ."res/like.png' />Mi piace!</a> Commenti: " . $stmt->rowCount() ."</small>";
    echo "</section>";
}

function printComment($comment, $idUser, $level)
{
    global $pdo;
    $query = "SELECT username FROM users WHERE id = :idUser";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':idUser', $idUser, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo "<section><small>" . htmlspecialchars($user['username']) . ":</small><br>
    <p>" . htmlspecialchars($comment) . "</p>";
    echo "</section>";
}

//coming soon
function printVote($voto)
{
}

function buildPath($level)
{
    if($level==0)
    {
        return "./";
    }
    $path="";
    for($i=0; $i<$level; $i++)
    {
        $path.="../";
    }
    return $path;
}
?>