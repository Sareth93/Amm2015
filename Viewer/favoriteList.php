<?php
    echo "Canzoni preferite: ";
    echo "<table align='center'>";
    echo "<tr><th>Titolo</th><th>Artista</th></tr>";
    $songs=array();
    while($row=$result->fetch_row()){
        $songs[]=$row;
        echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";
    }
    echo "</table>";
    /*if(count($songs)>0){
        echo "<br>Seleziona la canzone che desideri rimuovere dai preferiti<br>";
        echo "<form action='index.php?arg=removeFavorite' method='POST'>";
        echo "<select name='song'>";
        foreach($songs as $item){
            echo "poba";
            echo"<option value='$item[3]'>$item[0]</option>";}
        echo "</select><br>";
        echo "<input type='submit' id='confirm' name='confirm' value='rimuovi preferito'/>";
        echo "</form>";
    }*/
?>
