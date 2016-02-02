<!DOCTYPE html>

<html>
    <head>
        <meta http-equip="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="Css/style.css" type="text/css">
        <script  type="text/javascript" src="time.js"></script>
        <title>Home Page</title>
    </head>
    <body>
        <div id="page">
            <div id="header"></div>
            <div id="time"></div><script type="text/javascript">window.onload=time();</script>
            <div id="content">
                <?php
                    if(isset($_REQUEST['arg']))
                        $value=$_REQUEST['arg'];
                    else
                        $value="";
                    include_once("Controller/controller.php");
                    
                    $controller=new controller();
                    $controller->content($value);
                ?>
            </div>
        </div>
    </body>
</html>
