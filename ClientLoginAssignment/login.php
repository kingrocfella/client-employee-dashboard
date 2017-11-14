
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

//verify the user
$verifyuser = 'CALL verifyuser();';
$verifyquery = $connection->query($verifyuser);
// begin a session
    session_start();


//loop through the database and log the verified user in..
if ($verifyquery->num_rows > 0 ){
    while($row = $verifyquery->fetch_assoc()){
        $getuseremail = $row['Email'];
        $getpassword = $row['Password'];
        if (($getuseremail == $loginemail) && ($getpassword == $loginpassword)){
            $_SESSION['clientmail'] = $loginemail;
            $_SESSION['clientpass'] = $loginpassword;
            $_SESSION['clientname'] = $row['FirstName']." ".$row['LastName'];
            $_SESSION['clientnum'] = $row['PhoneNumber'];
            header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/ClientLoginAssignment/clientdashboard.php");  
            exit();
        }   
    }
    header("Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/ClientLoginAssignment/wrongemail.html"); 
    exit();
}



?>