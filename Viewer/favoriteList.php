<?php
    echo "Canzoni preferite: ";
    echo "<table align='center'>";
    echo "<tr><th>Titolo</th><th>Artista</th><th>Preferito di</th></tr>";
    $songs=array();
    while($row=$result->fetch_row()){
        $songs[]=$row;
        echo "<tr><td>$row[0]</td><td>$row[1] $row[2]</td></td>$row[3]</td></tr>";
    }
    echo "</table>";
    if(count($songs)>0){
        echo "<br>Seleziona la canzone che desideri rimuovere dai preferiti<br>";
        echo "<form action='index.php?arg=removeFavorite' method='POST'>";
        echo "<select name='song'>";
        foreach($songs as $temp)
            echo"<option value='$temp[4]'>$temp</option>";
        echo "</select><br><input type='submit' id='conferma' name='conferma' value='rimuovi preferito'/>";
        echo "</form>";
    }
?>
