<?php
if(isset($_POST["submit"]))
{
    //getting data
    $email=$_POST["email"];
    $pwd=$_POST["pwd"];

    //instantiate signup controller class
    include "./classes/dbh.classes.php";
    include "./classes/login.classes.php";
    include "./classes/login-contr.classes.php";
    $login = new LoginContr($email, $pwd);

    //running error handlers and user signup    
    $login->loginUser();

    $host="localhost";
    $user="root";
    $password="";
    $db="myrentbuddy";

    $data=mysqli_connect($host,$user,$password,$db);
    if($data===false){
        die("connection error");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $sql="SELECT * FROM users WHERE users_email='".$email."'";
        $result=mysqli_query($data,$sql);
        $row=mysqli_fetch_array($result);

        if($row["users_utype"]=="Admin")
        {
            header("location:adminhome.php");
        }
        elseif($row["users_utype"]=="Renter")
        {
            header("location:userhome.php");
        }
    }
}
?>