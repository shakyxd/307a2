<?php
include_once 'header.php';
$host="localhost";
$user="root";
$password="";
$db="myrentbuddy";
$id=$_GET['id'];
$data=mysqli_connect($host,$user,$password,$db);
if($data===false){
    die("connection error");
}
if(isset($_SESSION["userid"])){
    $uid=$_SESSION["userid"];
}
?>
    </br></br>
    <h2>Your Receipt:</h2></br>
    <?php
    $sql="SELECT * FROM bookings WHERE booking_id=$id";
    $result=mysqli_query($data,$sql);
    while($row=$result->fetch_assoc()){
        $rentcost=(($row['days_rented'])*($row['cars_cost']));
        $overduecost=(($row['days_overdue'])*($row['cars_overcost']));
        $totalcost=$rentcost+$overduecost;
        echo"<div class=receiptcontainer>";
        echo"<h4> Charges for $row[days_rented] days of car rental at standard rate of $$row[cars_cost]:  $$rentcost</h4></br>";
        echo"<h4> Charges for $row[days_overdue] days of overdue at rate of $$row[cars_overcost]:  $$overduecost</h4></br>";
        echo"<h4> Your Total Cost:</h4> <h2>$$totalcost</h2></br></br>";
        echo"<h4> Pay by Front Counter</h4>";
        echo"</div>";
    }
    ?>
    <a href="userhome.php" class="anothercar"> Ok </a>
    </body>
</html>