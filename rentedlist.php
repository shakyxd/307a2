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
                <th>Extend/Return</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql="SELECT * FROM bookings WHERE users_id=$uid";
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
                        <td>
                            <a href='extendrent.php?id=$row[booking_id]' class='modbtn'>Extend Rent</a>
                            <a href='returncar.php?id=$row[booking_id]' class='modbtn'>Return Car</a>
                        </td>
                    </tr>";
                }
                else{
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
            }
            ?>
        </tbody>
    </table>
    </body>
</html>