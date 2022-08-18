<?php
if(isset($_POST["submit"]))
{
    //getting data
    $uid=$_POST["uid"];
    $pwd=$_POST["pwd"];
    $utype=$_POST["utype"];

    //instantiate signup controller class
    include "./classes/dbh.classes.php";
    include "./classes/signup.classes.php";
    include "./classes/signup-contr.classes.php";
    $signup = new SignupContr($uid,$pwd,$utype);

    //running error handlers and user signup    
    $signupUser->signupUser();
    //going back to front page
    header("location:index.php?error=none");
}
?>