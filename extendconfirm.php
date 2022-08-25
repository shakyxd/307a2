<?php
include_once 'header.php';
$host="localhost";
$user="root";
$password="";
$db="myrentbuddy";
$cid=$_GET['cid'];
$days=$_GET['days'];
$bid=$_GET['bid'];
$instr="+".$days." days";
$data=mysqli_connect($host,$user,$password,$db);
if($data===false){
    die("connection error");
}
if(isset($_SESSION["userid"])){
    $uid=$_SESSION["userid"];
}
?>
    </br></br>
    <h2>Confirmation of your extension of booking:</h2></br>
    <?php
    $sql="SELECT * FROM cars WHERE cars_id=$cid";
    $result=mysqli_query($data,$sql);
    $sqltwo="SELECT * FROM bookings WHERE booking_id=$bid";
    $resulttwo=mysqli_query($data,$sqltwo);
    while($rowtwo=$resulttwo->fetch_assoc()){
        $startingdate=$rowtwo['startDate'];
    }
    $date=date_create($startingdate);
    date_add($date,date_interval_create_from_date_string($instr));
    while($row=$result->fetch_assoc()){
        echo"<div class=receiptcontainer>";
        echo"<h4> Standard rate for booked car: $$row[cars_cost]</h4></br>";
        echo"<h4> Overdue rate for booked car: $$row[cars_overcost]</h4></br>";
        echo"<h4> Return Car By:</h4> <h2>";
        echo date_format($date, "d-m-Y");
        echo"</h2></br></br>";
        echo"<h4> You will be charged accordingly when you return the car.</h4>";
        echo"</div>";
    }
    ?>
    <a href="userhome.php" class="anothercar"> Ok </a>
    </body>
</html>