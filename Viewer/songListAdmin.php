<!DOCTYPE html>

<html>
    <head>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
        <title>Song List</title>
    </head>
    <body>
        <?php
            echo "<form action='main.php?arg=deleteSong' method='POST'>";
            echo "Elenco canzoni";
            echo "<table align='center'";
            echo "<tr><th>Titolo</th><th>Artista</th></tr>";
            while($row=$song->fetch_row())
                    echo"<tr><td>$row[0]</td><td>$row[1] $row[2]</td> 
                         <td><button type='submit' id='delete$row[3]' name='delete' value='$row[3]'>Cancella</button></tr>";                           
            echo "</table><br><br>";
            echo "</form>";
            
            echo "<p>Inserisci nuova canzone</p>";
            echo "<form action='main.php?arg=newSong' method='POST'
                  <label>Titolo Canzone</label>
                  <input type='text' name='titol' id='titol' required/><br>
                  <label>Artista</label>
                  <select name='artist'>";
                  while($row=$artist->fetch_row())
                      echo "<option value='$row[2]'>$row[0] $row[1]</option>";
            echo "</select><input type='submit' id='confirm' name='confirm' value='Add song'/><br><br><br>";
        ?>
    </body>
</html>