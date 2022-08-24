<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Rent Buddy</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    </head>
    <body style="background-color:#D3D3D3;">
    <header>
        <nav>
            <div>
                <h3><a href=index.php>My Rent Buddy</a></h3>
            </div>
            <ul class="menu-member">
                <?php
                    if(isset($_SESSION["userid"]))
                    {
                ?>
                    <li><?php echo $_SESSION["useremail"];?></li>
                    <li><a href="logout.php" class="header-login-a">LOGOUT</a></li>
                <?php
                    }
                    else
                    {
                ?>
                    <li><a href="index.php">Not Logged In</a></li>
                <?php
                    }
                ?>
            </ul>
        </nav>
    </header>