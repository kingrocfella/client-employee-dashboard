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




$trpaid = $_GET['paid'];
$id = $_GET['id'];


$query = $connection->prepare("INSERT INTO treasurydashboard ( CustomerID, Paid, CashierName) VALUES (?,?,?)");


//insert details of the client that has been paid into database
$query->bind_param("sss",$id,$trpaid,$_SESSION["employeename"]);

if($query->execute() == true){
    
    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/viewpaidclients.php"); //Redirect to the paid dashboard 
    exit();
   
}

else{
    echo 'error'.$connection->error;
}












?>z