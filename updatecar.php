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
$id="";
$plate="";
$model="";
$type="";
$status="";
$cost="";
$overcost="";
$errorMessage="";
$successMessage="";

if($_SERVER['REQUEST_METHOD']=='GET'){
    if(!isset($_GET["id"])){
        header("location:adminhome.php");
        exit;
    }

    $id = $_GET["id"];

    $sql="SELECT * FROM cars WHERE cars_id=$id";
    $result=$data->query($sql);
    $row=$result->fetch_assoc();
    if(!$row){
        header("location:adminhome.php");
        exit;
    }
    $plate=$row["cars_plate"];
    $model=$row["cars_model"];
    $type=$row["cars_type"];
    $status=$row["cars_status"];
    $cost=$row["cars_cost"];
    $overcost=$row["cars_overcost"];
}
else{
    $id=$_POST["id"];
    $plate= $_POST["plate"];
    $model= $_POST["model"];
    $type=$_POST["type"];
    $status=$_POST["status"];
    $cost=$_POST["cost"];
    $overcost=$_POST["overcost"];

    do{
        if(empty($id)||empty($plate)||empty($model)||empty($type)||empty($status)||empty($cost)||empty($overcost)){
            $errorMessage="All fields are required";
            break;
        }
            $sql="UPDATE cars SET cars_plate='$plate', cars_model='$model', cars_type='$type', cars_status='$status',
             cars_cost='$cost', cars_overcost='$overcost' WHERE cars_id=$id";
            $result=mysqli_query($data,$sql);
            if(!$result){
                $errorMessage="Invalid query: ".$data->error;
                break;
            }

            $successMessage="Car updated successfully";

            header("location:adminhome.php");
            exit;
    }while(false);
}
?>
    <div class="insertcarform-container"> 
        <h2>Update Car Details</h2></br>
        <?php
        if(!empty($errorMessage)){
            echo "<strong>$errorMessage</strong>";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value ="<?php echo $id;?>">
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
            <a href="adminhome.php" class="delbtn"role="button">Cancel</a>
        </form>
    </div>

    </body>
</html>