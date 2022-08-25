<?php
include_once 'header.php';
$host="localhost";
$user="root";
$password="";
$db="myrentbuddy";

$data=mysqli_connect($host,$user,$password,$db);
if($data===false){
    die("connection error");
}
if(isset($_SESSION["userid"])){
    $uid=$_SESSION["userid"];
}
$id=$_GET["id"];
$extenddays="";
?>
    </br></br>
    <h2>Your Bookings:</h2></br>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Car ID</th>
                <th>Plate</th>
                <th>Cost per day($)</th>
                <th>Overdue cost per day($)</th>
                <th>Start Date</th>
                <th>Days Rented</th>
                <th>Overdue days</th>
                <th>Total Cost</th>
                <th>Returned?</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="SELECT * FROM bookings WHERE booking_id=$id";
            $result=mysqli_query($data,$sql);
            while($row=$result->fetch_assoc()){
                $rentcost=(($row['days_rented'])*($row['cars_cost']));
                $overduecost=(($row['days_overdue'])*($row['cars_overcost']));
                $totalcost=$rentcost+$overduecost;
                if($row['return_status']=="Not Returned"){
                    echo "<tr>
                        <td>$row[booking_id]</td>
                        <td>$row[cars_id]</td>
                        <td>$row[cars_plate]</td>
                        <td>$row[cars_cost]</td>
                        <td>$row[cars_overcost]</td>
                        <td>$row[startDate]</td>
                        <td>$row[days_rented]</td>
                        <td>$row[days_overdue]</td>
                        <td>$totalcost</td>
                        <td>$row[return_status]</td>
                        </tr>";
                }
                $oldrentdays=$row['days_rented'];
                $caridtemp=$row['cars_id'];
                $bookingidtemp=$row['booking_id'];
            }
            ?>
            
        </tbody>
    </table></br></br>
            <form method="POST" class="rentsection">
            <input type="number" required id="extenddays" name="extenddays" min="1" placeholder="No. of days to extend" value="<?php echo$extenddays?>">
            <label class="textlabel">Days</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="submit" class="insertcarsubmitbtn">Extend</button>
            </form>
            <?php
            $today=date('d-m-Y');
            if(isset($_POST['extenddays'])){
                $extenddays=$_POST['extenddays'];
                $newrentdays=$oldrentdays+$extenddays;
                $sql="UPDATE bookings SET days_rented='$newrentdays' WHERE booking_id='$id'";
                $result=mysqli_query($data,$sql);
                header("location:extendconfirm.php?cid=$caridtemp&days=$newrentdays&bid=$bookingidtemp");
            }
            ?>
    </body>
</html>