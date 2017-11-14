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




$aoverify = $_GET['verified'];
$id = $_GET['id'];

//insert verified details of the client into database.
$query = $connection->prepare("INSERT INTO supdashboard  ( CustomerID, Verified, SupervisorName) VALUES (?,?,?)");



$query->bind_param("sss",$id,$aoverify,$_SESSION["employeename"]);

if($query->execute() == true){
    
    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/supervisordashboard.php"); //Redirect to his dashboard 
    exit();
   
}

else{
    echo 'error'.$connection->error;
}












?>