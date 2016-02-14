<?php
    echo "Inserisci una nuova canzone";
    echo "<br><label>Titolo canzone</label>
          <input type='text' name='title' id='title' required=required'/></br>
          <label>Artista</label>";
    while($row=$artist->fetch_row())
        echo "<option value='$row[1]'>$row[0]</option>";
    echo "</select><input"
    
?>

                        
            echo "<p>Inserisci nuova canzone</p>";
            echo "<form action='index.php?arg=newSong' method='POST'>
                  <label>Titolo Canzone</label>
                  <input type='text' name='title' id='title' required='required'/><br>
                  <label>Artista</label>
                  <select name='artistName'>";
            while($row=$artistName->fetch_row())
                echo "<option value='$row[1]'>$row[0]</option>";
            echo "</select><input type='submit' id='confirm' name='confirm' value='Add song'/><br>";