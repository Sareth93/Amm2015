<?php
    $user=$_SESSION['username'];
    echo '<div id="tab"><a href="index.php?arg=logout">';
    echo $user;
    echo "/ logout";
    echo '</a></div>';
?>
