<?php
    if(isset($_GET["id"])){
        $id=$_GET["id"];
        $host="localhost";
        $user="root";
        $password="";
        $db="myrentbuddy";

        $data=mysqli_connect($host,$user,$password,$db);
        if($data===false){
            die("connection error");
        }
        $sql="DELETE FROM cars WHERE cars_id=$id";
        $data->query($sql);
    }
    header("location:adminhome.php");
    exit;
?>