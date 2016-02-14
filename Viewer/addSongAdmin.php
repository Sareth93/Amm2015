<?php
    echo "Inserisci una nuova canzone";
    echo "<form action='index.php?arg=addSong' method='POST'>
          <br><label>Titolo canzone</label>
          <input type='text' name='title' id='title' required=required'/></br>
          //<label>Artista</label><select name='artistName'>";
    echo "<tr><th>Artista</th></tr>";
    while($row=$artists->fetch_row())
        echo "<tr><td>$row[0]</td></tr>";
   // echo "</select><input type='submit' id='confirm' name='confirm' value='Add song'/><br>";    
?>