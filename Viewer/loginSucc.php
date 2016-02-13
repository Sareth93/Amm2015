<?php
    $user=$_SESSION['username'];    
    echo "Accesso effettuato. Benvenuto $user!";    
    echo "<form action='index.php?arg=logout' meth='POST'><button type='logout' name='logout'>Logout</button></form>";
?>


