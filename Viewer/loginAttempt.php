<!DOCTYPE html>
<html>
    <head>
        <title>Tentativo Login</title>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body>
        <h3>Navigare sul sito richiede il login</h3>
        <form action="main.php?arg=login" method="POST">
            <label>Username</label>
            <input id="username" value="" name="username" type="text" required="required" />
            <br>
            <label>Password</label>
            <input id="password" name="password" type="password" required="required"/>
            <br>
            <button type="login" name="login">Login</button>            
        </form>
    </body>
</html>