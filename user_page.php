<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>User</title>
    </head>
    <body>
        <header>
            <h2>Mwe</h2>
            <nav>
                <a href="#">Home</a>
                <a href="#">Blog</a>
                <a href="#">Contact</a>
                <a href="#">About</a>
            </nav>
            <?php
                if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']==true)
                {
                    echo "
                    <div class='user'> $_SESSION[username] <a href='logout.php'> - LOGOUT</a> </div>
                    ";
                }
                else
                {
                    
                }
                
            ?>
            
        </header>
        <?php
            #echo "<h1>TANGINA</h1>";
            $d = $_SESSION['username'];
            #echo "$d";
            echo "<h1 style='text-align: center; margin-top: 200px'> WELCOME USER! - " . $d . "</h1>";
            echo "<img src='twerkingsus.gif' style='display: block; margin-left: auto; margin-right: auto; width: 500px'/>";
        ?>  
    </body>
    

</html>