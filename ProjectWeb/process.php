<?php 
    session_start();
    $update = false;
    $name = '';
    $amount = '';
    $total = 0;


    $con = new mysqli("localhost","root","","budget_calculator");

    if($con -> connect_error){
        die("Connection failed: ".$con->connect_error);
    }
    if(isset($_POST["save"])){
        echo "true";
        $budget = $_POST["budget"];
        $amount = $_POST["amount"];
        $query = mysqli_query($con,"INSERT INTO budget (name ,amount) VALUE ('$budget', '$amount')");
        
        $_SESSION["message"] = "Record have been saved !";
        $_SESSION["msg_type"] = "primary";
        header("location: index.php?result=true");
    }
    
?>