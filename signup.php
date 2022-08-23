<?php
if(isset($_POST["submit"]))
{
    //getting data
    $uid=$_POST["uid"];
    $surname=$_POST["surname"];
    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $pwd=$_POST["pwd"];
    $utype=$_POST["utype"];

    //instantiate signup controller class
    include "./classes/dbh.classes.php";
    include "./classes/signup.classes.php";
    include "./classes/signup-contr.classes.php";
    $signup = new SignupContr($uid, $surname, $email,$phone, $pwd, $utype);

    //running error handlers and user signup    
    $signup->signupUser();
    //going back to front page
    header("location:index.php?error=none");
}
?>