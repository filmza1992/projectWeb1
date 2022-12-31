<?php 
    session_start();
    $update = false;
    $name = '';
    $amount = '';
    $total = 0;
    $id = '';

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
    
    $result = mysqli_query($con , "SELECT * from budget");
    while($row = $result->fetch_assoc()){
        $total = $total + $row['amount'];
    }

    if(isset($_GET["delete"])){
        $id = $_GET['delete'];

        $query = mysqli_query($con ,"DELETE from budget where id = $id");
        $_SESSION['message'] = "Recode has been Delete !";
        $_SESSION['msg_type'] = "danger";

        header("location: index.php");
    }

    if(isset($_GET["edit"])){
        $id = $_GET["edit"];
        $update = true;
        $result = mysqli_query($con , "SELECT * from budget where id = $id");


        if(mysqli_num_rows($result) == 1){
            $row = $result->fetch_assoc();
            $name = $row['name'];
            $amount = $row['amount'];
        }
    }

    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $budget = $_POST['budget'];
        $amount = $_POST['amount'];

        $query = mysqli_query($con , "UPDATE budget set name = '$budget' ,amount = '$amount' where id = '$id'");
        $_SESSION["message"] = "Recode has been update !";
        $_SESSION["msg_type"] = "success";

        header("location:index.php");
    }
?>