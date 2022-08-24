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

$plate="";
$model="";
$type="";
$status="";
$cost="";
$overcost="";
$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $plate= $_POST["plate"];
    $model= $_POST["model"];
    $type=$_POST["type"];
    $status=$_POST["status"];
    $cost=$_POST["cost"];
    $overcost=$_POST["overcost"];

    do{
        if(empty($plate)||empty($model)||empty($type)||empty($status)||empty($cost)||empty($overcost)){
            $errorMessage="All fields are required";
            break;
        }
            $sql="INSERT INTO cars (cars_plate, cars_model, cars_type,cars_status, cars_cost, cars_overcost)
                    VALUES('$plate','$model','$type','$status','$cost','$overcost')";
            $result=mysqli_query($data,$sql);
            if(!$result){
                $errorMessage="Invalid query: ".$data->error;
                break;
            }
            $plate="";
            $model="";
            $type="";
            $status="";
            $cost="";
            $overcost="";

            $successMessage="Car added successfully";

            header("location:adminhome.php");
            exit;
    }while(false);
}

?>
    <div class="insertcarform-container"> 
        <h2>Insert a New Car</h2></br>
        <?php
        if(!empty($errorMessage)){
            echo "<strong>$errorMessage</strong>";
        }
        ?>
        <form method="post">
            <label>Car Plate:</label>
            <input type="text" class="insertcarform" name="plate" value="<?php echo $plate;?>" placeholder="SFA1234J">
            </br><label>Car Model:</label>
            <input type="text" class="insertcarform" name="model" value="<?php echo $model;?>" placeholder="2003 Honda Civic">
            </br><label>Car Type:</label>
            <input type="text" class="insertcarform" name="type" value="<?php echo $type;?>" placeholder="SUV">
            </br><label>Status:</label>
            <select id="addcarstatus" name="status" value="<?php echo$status;?>">
                <option value="Available">Available</option>
                <option value="Rented">Rented</option>
                <option value="Overdue">Overdue</option>
            </select>
            </br><label>Cost per day($):</label>
            <input type="number" class="insertcarform" name="cost" value="<?php echo $cost;?>" placeholder="100.00">
            </br><label>Cost per overdue day($):</label>
            <input type="number" step="any"class="insertcarform" name="overcost" value="<?php echo $overcost;?>" placeholder="120.00">
            <?php
                if(!empty($successMessage)){
                    echo"<strong>$successMessage</strong>";
                    
                }
            ?>
            </br></br><button type="submit" class="insertcarsubmitbtn">Submit</button>
            <a href="adminhome.php" class=delbtn role="button">Cancel</a>
        </form>
    </div>

    </body>
</html>