<?php
include_once 'header.php';
?>
    <section class="index-login">
        <div class="wrapper">
            <div class="index-login-signup">
                </br>
                <h4>SIGN UP</h4>
                <p>Don't have an account yet? Sign up here!</p>
                <form action="signup.php" method="post">
                    <input type="text" id="uid" name="uid" placeholder="First Name"></br>
                    <input type="text" id="surname" name="surname" placeholder="Surname"></br>                    <input type="text" id="email" name="email" placeholder="email address"></br>
                    <input type="text" id="phone" name="phone" placeholder="Phone number"></br>
                    <input type="password" id="pwd" name="pwd" placeholder="Password"></br>
                    <input type="radio" id="utypeadmin" name="utype" value="Admin">
                    <label for="utypeadmin">Admin</label>&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="utyperenter" name="utype" value="Renter">
                    <label for="utyperenter">Renter</label></br>
                    <button type="submit" name="submit">SIGN UP</button>
                </form>
            </div>
                </br></br>
            <div class="index-login-login">
                <h4>LOGIN</h4>
                <p>Already have an account? Login here!</p>
                <form action="login.php" method="post">
                    <input type="text" id="email"name="email" placeholder="email address"></br>
                    <input type="password" id="pwd" name="pwd" placeholder="Password"></br>
                    <button type="submit" name="submit">LOGIN</button>
                </form>
            </div>
        </div>
    </section>
    </body>
</html>
