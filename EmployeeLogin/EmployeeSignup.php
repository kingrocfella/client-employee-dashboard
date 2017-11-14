<?php

$servername = "localhost";
$username = "root";
$password = "Stoneage1992.";
$database = "vfd";

$connection = new mysqli($servername,$username,$password,$database);
// check connection
if ($connection->connect_error){
    die("The connection failed".connect_error);
}

// init variables from the signup form
$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$useremail = $_POST["email"];
$phonenumber = $_POST["phonenumber"];
$position = $_POST["position"];
$userpassword = $_POST["password"];
$employeename = $firstname." ".$lastname;
//begin session
session_start();
$_SESSION['employeeloginemail'] = $useremail;
$_SESSION['employeeloginpass'] = $userpassword;
$_SESSION['employeename'] = $firstname." ".$lastname;
// insert into clientdatabase
$query = $connection->prepare("INSERT INTO employeedb (FirstName, LastName, Email, Position, PhoneNumber, Password, FullName) VALUES (?,?,?,?,?,?,?)");
$query->bind_param("sssssss",$firstname,$lastname,$useremail,$position,$phonenumber,$userpassword,$employeename);

if($query->execute() == true){
    if ($position == 'Accounting Officer'){
        header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/AccountOfficerdashboard.php");  /* Redirect to aodashboard */ 
        exit();
    }
    else if ($position == 'Supervisor'){
        header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/supervisordashboard.php");  /* Redirect to supervisordashboard */ 
        exit();
    }
    else if ($position == 'C.E.O'){
        header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/ceodashboard.php");  /* Redirect to ceodashboard */ 
        exit();
    }
    else if ($position == 'Treasury'){
        header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/treasurydashboard.php");  /* Redirect to ceodashboard */ 
        exit();
    }
}
else {
    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/redirectemployeelogin.html"); /* Redirect to signin page */ 
    exit();
}


?>