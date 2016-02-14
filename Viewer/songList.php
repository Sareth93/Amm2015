<!DOCTYPE html>

<html>
    <head>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
        <title>Song List</title>
    </head>
    <body>
        <?php
            echo "Elenco Canzoni: ";
            echo "<table align='center'";
            echo "<tr><th>Titolo</th><th>Artista</th></tr>";
            while($row=$songs->fetch_row())
                    echo"<tr><td>$row[0]</td><td>$row[2]</td> </tr>";
            echo"</table>";
            
            echo "<p>Inserisci una nuova canzone</p>";
            echo "<form action='index.php?arg=newSong' method='POST'>
                  <label>Titolo Canzone</label>
                  <input type='text' name='title' id='title' required='required'/><br>
                  <label>Artista</label>
                  <select name='artist'>";
            while($row=$artist->fetch_row())
                echo "<option value='$row[1]'>$row[0]</option>";
            echo "</select><input type='submit' id='confirm' name='confirm' value='Add song'/><br>"; 
        ?>
    </body>
</html>