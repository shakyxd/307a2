<?php
include_once 'header.php';
$host="localhost";
$user="root";
$password="";
$db="myrentbuddy";
$cid=$_GET['cid'];
$days=$_GET['days'];
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
    <h2>Confirmation of your booking:</h2></br>
    <?php
    $sql="SELECT * FROM cars WHERE cars_id=$cid";
    $result=mysqli_query($data,$sql);
    $today=date("d-m-Y");
    $returndate=Date("d-m-Y", strtotime($instr));
    while($row=$result->fetch_assoc()){
        echo"<div class=receiptcontainer>";
        echo"<h4> Standard rate for booked car: $$row[cars_cost]</h4></br>";
        echo"<h4> Overdue rate for booked car: $$row[cars_overcost]</h4></br>";
        echo"<h4> Return Car By:</h4> <h2>$returndate</h2></br></br>";
        echo"<h4> You will be charged accordingly when you return the car.</h4>";
        echo"</div>";
    }
    ?>
    <a href="userhome.php" class="anothercar"> Ok </a>
    </body>
</html>