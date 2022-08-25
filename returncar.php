<?php
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $cid=$_GET["cid"];
        $host="localhost";
        $user="root";
        $password="";
        $db="myrentbuddy";
        $returned="Returned";
        $ava="Available";

        $data=mysqli_connect($host,$user,$password,$db);
        if($data===false){
            die("connection error");
        }
        $sql="UPDATE bookings SET return_status='$returned' WHERE booking_id=$id";
        $data->query($sql);

        $sqltwo="UPDATE cars SET cars_status='$ava' WHERE cars_id=$cid";
        $data->query($sqltwo);
    }
    header("location:receipt.php?id=$id");
    exit;
?>