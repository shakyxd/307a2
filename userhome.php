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
    <div class="admin">
        <ul class="admin-menu">
            <li><a href="rentedlist.php?uid=<?php echo $uid;?>" class="admin-menu-item">View your Rented Cars</a></li>
        </ul>
    </div>
    </br></br>
    <form method="GET" class="searchbar">
        <label>Search:</label>
        <input type="text" required name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];
        }?>">
        <button type="submit" name="submit" class="modbtn">Submit</button>
        <a href="userhome.php" class="modbtn" role="button">Refresh</a>
    </form>
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
                <th>Rent</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            if(!isset($_GET['search'])){
                $sql="SELECT * FROM cars WHERE cars_status='Available'";
                $result=mysqli_query($data,$sql);
                while($row=$result->fetch_assoc()){
                    echo "<tr>
                            <td>$row[cars_id]</td>
                            <td>$row[cars_plate]</td>
                            <td>$row[cars_model]</td>
                            <td>$row[cars_type]</td>
                            <td>$row[cars_status]</td>
                            <td>$row[cars_cost]</td>
                            <td>$row[cars_overcost]</td>
                            <td>
                                <a href='rentcar.php?id=$row[cars_id]&uid=$uid' class='modbtn'>Rent Car</a>
                            </td>
                        </tr>";    
                }
            }
            else{
                $filtervalues=$_GET['search'];
                $query="SELECT * FROM cars WHERE CONCAT(cars_plate,cars_model,cars_type) LIKE '%$filtervalues%'";
                $query_run=mysqli_query($data,$query);
                if(mysqli_num_rows($query_run)>0){
                    foreach($query_run as $items){
                        echo "<tr>
                            <td>$items[cars_id]</td>
                            <td>$items[cars_plate]</td>
                            <td>$items[cars_model]</td>
                            <td>$items[cars_type]</td>
                            <td>$items[cars_status]</td>
                            <td>$items[cars_cost]</td>
                            <td>$items[cars_overcost]</td>
                            <td>
                                <a href='rentcar.php?id=$items[cars_id]&uid=$uid' class='modbtn'>Rent Car</a>
                            </td>
                        </tr>";
                    }
                }else{
                    echo "<tr><td colspan='8'>No Record Found</td></tr>";
                }
            }
            ?>
        </tbody>
    </table>
    </body>
</html>