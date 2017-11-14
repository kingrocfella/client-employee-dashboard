
<?php

 $servername= "localhost";
 $username = "root";
 $password = "Stoneage1992.";
 $database = "vfd";

 $connection = new mysqli($servername,$username,$password,$database);
 //check connection
 if ($connection->connect_error){
    die("The connection failed   ".connect_error);
}
//INIT Variables
$loginemail = $_POST["loginemail"];
$loginpassword = $_POST["loginpassword"];
$loginposition = $_POST["position"];
//begin session

session_start();
$_SESSION['employeeloginemail'] = $loginemail;
$_SESSION['employeeloginpass'] = $loginpassword;


//verify the user
$verifyemployee = 'SELECT * FROM EMPLOYEEDB;';
$verifyquery = $connection->query($verifyemployee);



$getaofullname = 'SELECT FirstName,LastName FROM EMPLOYEEDB WHERE Email = "'.$loginemail.'";';
$query = $connection->query($getaofullname);
$result  = $query->fetch_assoc();
$_SESSION['employeename'] = $result['FirstName']." ".$result['LastName'];

//loop through the database and log the verified user in..
if ($verifyquery->num_rows > 0 ){
    while($row = $verifyquery->fetch_assoc()){
        $getuseremail = $row['Email'];
        $getpassword = $row['Password'];
        $getposition = $row['Position'];
        if (($getpassword == $loginpassword) && (($getuseremail == $loginemail))){
                if ($getposition == 'Accounting Officer'){
                    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/AccountOfficerdashboard.php"); //Redirect to dashboard 
                    exit();
                }
                else if ($getposition == 'Supervisor'){
                    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/supervisordashboard.php");  //Redirect to dashboard 
                    exit();
                }
                else if ($getposition == 'C.E.O'){
                    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/ceodashboard.php"); //Redirect to dashboard 
                    exit();
                }
                else if ($getposition == 'Treasury'){
                    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/treasurydashboard.php"); //Redirect to dashboard 
                    exit();
                }
                
        }   
    }
                header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/wrongemployeelogin.html"); // Redirect to signin page 
                exit();
} 
    
?>


