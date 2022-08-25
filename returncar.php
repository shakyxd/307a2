<?php
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $host="localhost";
        $user="root";
        $password="";
        $db="myrentbuddy";
        $returned="Returned";

        $data=mysqli_connect($host,$user,$password,$db);
        if($data===false){
            die("connection error");
        }
        $sql="UPDATE bookings SET return_status='$returned' WHERE booking_id=$id";
        $data->query($sql);
    }
    header("location:receipt.php?id=$id");
    exit;
?>