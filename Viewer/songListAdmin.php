<!DOCTYPE html>

<html>
    <head>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
        <title>Songs List</title>
    </head>
    <body>
        <?php
            echo "<form action='index.php?arg=deleteSong' method='POST'>";
            echo "Elenco canzoni";
            echo "<table align='center'";
            echo "<tr><th>Titolo</th><th>Autore</th></tr>";
            while($row=$songs->fetch_row())
                    echo"<tr><td>$row[0]</td><td>$row[1]</td>
                         <td><button type='submit' id='delete$row[1]' name='delete' value='$row[1]'>Cancella</button></tr>";                           
            echo "</table><br>";
            echo "</form>";
        ?>
    </body>
</html>