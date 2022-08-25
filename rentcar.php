<?php
include_once "header.php";

$host="localhost";
$user="root";
$password="";
$db="myrentbuddy";

$data=mysqli_connect($host,$user,$password,$db);
if($data===false){
    die("connection error");
}
$id="";
$uid="";
$plate="";
$model="";
$type="";
$status="";
$cost="";
$overcost="";

$rentdays="";
$returnstatus="";
$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='GET'||$_SERVER['REQUEST_METHOD']=='POST'){
    if(!isset($_GET["id"])){
        header("location:userhome.php");
        exit;
    }

    $id = $_GET["id"];
    $uid= $_GET["uid"];

    $sql="SELECT * FROM cars WHERE cars_id=$id";
    $result=$data->query($sql);
    $row=$result->fetch_assoc();
    if(!$row){
        header("location:userhome.php");
        exit;
    }
    $plate=$row["cars_plate"];
    $model=$row["cars_model"];
    $type=$row["cars_type"];
    $status=$row["cars_status"];
    $cost=$row["cars_cost"];
    $overcost=$row["cars_overcost"];
    $overdays=0;
    $returnstatus="Not Returned";
}

?>
    <div class="rentcar-container">
        <h2>Your chosen car and details:</h2>
    </br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Plate</th>
                    <th>Model</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Cost per day($)</th>
                    <th>Overdue cost per day($)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    echo "<tr>
                            <td>$id</td>
                            <td>$plate</td>
                            <td>$model</td>
                            <td>$type</td>
                            <td>$status</td>
                            <td>$cost</td>
                            <td>$overcost</td>
                        </tr>";    
                ?>
            </tbody>
        </table>
        <a href="userhome.php" class="anothercar">Choose another car</a>
            </br>
        <div class=tandc>
            <p>Terms and Conditions:</br>
            1. The renting period starts when you enter days and click rent.</br>
            2. You must return the car on the specified date or you will be charged overdue cost for the amount of days you exceed return date.</br>
            3. You can extend the renting period through "Your bookings" section.</br>
            4. Minimum renting duration is 1 day.</br>
            </p>
        </div>
            </br></br>
        <form method="POST" class="rentsection">
            <input type="number" required id="rentdays" name="rentdays" min="1" placeholder="No. of days to rent" value="<?php echo$rentdays?>">
            <label class="textlabel">Days</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="insertcarsubmitbtn">Rent Now</button>
        </form>
        <?php
        $today=date('d-m-Y');
        if(isset($_POST['rentdays'])){
            $statuschange="Rented";
            $rentdays=$_POST['rentdays'];
            $sql="INSERT INTO bookings(users_id,cars_id,cars_plate,cars_cost,cars_overcost,startDate,days_rented,days_overdue,return_status)
            VALUES('$uid','$id','$plate','$cost','$overcost','$today','$rentdays','$overdays','$returnstatus')";
            $result=mysqli_query($data,$sql);
            $sqltwo="UPDATE cars SET cars_status='$statuschange' WHERE cars_id=$id";
            $resulttwo=mysqli_query($data,$sqltwo);
            header("location:rentconfirm.php?cid=$id&days=$rentdays");
        }
        ?>
    </div>
    </body>
</html>