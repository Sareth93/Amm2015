<?php
    $user=$_SESSION['username'];
    echo '<div id=tab><a href="index.php?arg=logout">';
    echo $user;
    echo "/logout </a></div>";
    echo "<div id='tab'><a href='index.php?arg=songs'>Lista Canzoni</a></div>";
    echo "<div id='tab'><a href='index.php?arg=newSong'>Aggiungi una canzone</a></div>";
    echo "<div id='tab'><a href='index.php?arg=addArtist'>Aggiungi un autore</a></div>";
?>

