<?php
include_once 'header.php';
?>
    </br></br>
    <div class="admin">
        <ul class="admin-menu">
            <li><a href="insertcar.php" class="admin-menu-item">Insert a New Car</a></li>
            <li><a href="adminhome.php" class="admin-menu-item">List All Cars</a></li>
            <li><a href="adminhome.php?p=available" class="admin-menu-item">Available Cars Only</a></li>
            <li><a href="adminhome.php?p=rented" class="admin-menu-item">Rented Cars Only</a></li>
            <li><a href="adminhome.php?p=overdue" class="admin-menu-item">Overdue Cars Only</a></li>
        </ul>
    </div>
    </br></br>
    <form method="GET" class="searchbar">
        <label>Search:</label>
        <input type="text" required name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
        <button type="submit" name="submit" class="modbtn">Submit</button>
        <a href="adminhome.php" class="modbtn" role="button">Refresh</a>
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
                <th>modify</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $host="localhost";
            $user="root";
            $password="";
            $db="myrentbuddy";
        
            $data=mysqli_connect($host,$user,$password,$db);
            if($data===false){
                die("connection error");
            }
            if(isset($_GET['search'])){
                $filtervalues=$_GET['search'];
                $sql="SELECT * FROM cars WHERE CONCAT(cars_plate,cars_model,cars_type) LIKE '%$filtervalues%'";
            }
            elseif(isset($_GET['p'])&&$_GET['p']=="available"){
                $sql="SELECT * FROM cars WHERE cars_status='Available'";
            }
            elseif(isset($_GET['p'])&&$_GET['p']=="rented"){
                $sql="SELECT * FROM cars WHERE cars_status='Rented'";
            }
            elseif(isset($_GET['p'])&&$_GET['p']=="overdue"){
                $sql="SELECT * FROM cars WHERE cars_status='Overdue'";
            }
            else{
                $sql="SELECT * from cars";
            }
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
                            <a href='updatecar.php?id=$row[cars_id]' class='modbtn'>Update</a>
                            <a href='deletecar.php?id=$row[cars_id]' class='delbtn'>Delete</a>
                        </td>
                    </tr>";    
            }
            
            ?>
        </tbody>
    </table>
    </body>
</html>