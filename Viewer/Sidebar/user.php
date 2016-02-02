<?php
    $user=$_SESSION['username'];
    echo '<div id="tab"><a href="main.php?arg=logout">';
    echo $user;
    echo "/ logout";
    echo '</a></div>';
?>
