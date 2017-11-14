<?php
session_start();
if((isset($_SESSION['employeeloginemail'])) &&(isset($_SESSION['employeeloginpass'])) == false )
{
  header('Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/Employee.html');
  exit();
}



$servername = "localhost";
$username = "root";
$password = "Stoneage1992.";
$database = "vfd";

$connection = new mysqli($servername,$username,$password,$database);
// check connection
if ($connection->connect_error){
    die("The connection failed".connect_error);
}



//get details from the verify button
$aoverify = $_GET['verified'];
$id = $_GET['id'];


$query = $connection->prepare("INSERT INTO aodashboard ( CustomerID, Verified, EmployeeName) VALUES (?,?,?)");



$query->bind_param("sss",$id,$aoverify,$_SESSION["employeename"]);

if($query->execute() == true){
    
    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/AccountOfficerdashboard.php"); //Redirect to the dashboard 
    exit();
   
}

else{
    echo 'error'.$connection->error;
}













?>