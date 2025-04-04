<?php
function navbar($level)
{
    echo "<nav>
    <ul>
        <li><a href='" .  buildPath($level) . "index.php'>Home</a></li>
        <li><a href='" .  buildPath($level) . "register'>Registrati</a></li>
        <li><a href='" .  buildPath($level) . "login'>Login</a></li>
    </ul>
</nav>";
    
}
?>



