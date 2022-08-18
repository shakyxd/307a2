<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Rent Buddy</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    </head>
    <body>
    <header>
        <nav>
            <div>
                <h3>My Rent Buddy</h3>
            </div>
        </nav>
    </header>
    <section class="index-login">
        <div class="wrapper">
            <div class="index-login-signup">
                <h4>SIGN UP</h4>
                <p>Don't have an account yet? Sign up here!</p>
                <form action="signup.php" method="post">
                    <input type="text" id="uid" name="uid" placeholder="Username">
                    <input type="password" id="pwd" name="pwd" placeholder="Password">
                    <input type="radio" id="utypeadmin" name="utype" value="Admin">
                    <label for="utypeadmin">Admin</label>&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="utyperenter" name="utype" value="Renter">
                    <label for="utyperenter">Renter</label><br>
                    <button type="submit" name="submit">SIGN UP</button>
                </form>
            </div>
            <div class="index-login-login">
                <h4>LOGIN</h4>
                <p>Already have an account? Login here!</p>
                <form action="login.php" method="post">
                    <input type="text" id="uid"name="uid" placeholder="Username">
                    <input type="password" id="pwd" name="pwd" placeholder="Password">
                    <br>
                    <button type="submit" name="submit">LOGIN</button>
                </form>
            </div>
        </div>
    </section>
    </body>
</html>
