<?php
    $user=$_SESSION['username'];
    
    echo "Accesso effettuato. Benvenuto $user!";
    
    echo "<form action='main.php?arg=logout' meth='Post'><button type='logout' name='logout'>Logout</button></form>";
    
?>


