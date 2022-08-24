<?php
include_once 'header.php';
?>
    </br></br>
    <div class="admin">
        <ul class="admin-menu">
            <li><a href="insertcar.php" class="admin-menu-item">Insert a New Car</a></li>
            <li><a href="allcars.php" class="admin-menu-item">List All Cars</a></li>
        </ul>
    </div>
    </br></br>
    <table>
        <thead>
            <tr>
                <th>Plate</th>
                <th>Model</th>
                <th>Type</th>
                <th>Cost per day</th>
                <th>Overdue cost per day</th>
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
            $sql="SELECT * from cars";
            $result=mysqli_query($data,$sql);
            while($row=$result->fetch_assoc()){
                echo "<tr>
                        <td>".$row["cars_plate"]."</td>
                        <td>".$row["cars_model"]."</td>
                        <td>".$row["cars_type"]."</td>
                        <td>".$row["cars_cost"]."</td>
                        <td>".$row["cars_overcost"]."</td>
                        <td>
                            <a href='update' class='header-login-a'>Update</a>
                            <a href='delete' class='header-login-a'>Delete</a>
                        </td>
                    </tr>";    
            }
            
            ?>
        </tbody>
    </table>
    </body>
</html>