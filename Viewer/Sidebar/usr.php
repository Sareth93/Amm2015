<?php
    $user=$_SESSION['username'];
    echo "<div id='tab'><a href='index.php?arg=logout'>";
    echo $user;
    echo "/logout </a></div>";
    echo "<div id='tab'><a href='index.php?arg=songs'>Lista canzoni</a></div>";
    echo "<div id='tab'><a href='index.php?arg=register'>Registrati</a></div>";
?>
