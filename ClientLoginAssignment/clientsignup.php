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
$userpassword = $_POST["password"];
$fullname = $firstname." ".$lastname;
//start a session
// insert client details into clientdatabase
$query = $connection->prepare("INSERT INTO CLIENTDB (FirstName, LastName, Email, PhoneNumber, Password, FullName) VALUES (?,?,?,?,?,?)");
$query->bind_param("ssssss",$firstname,$lastname,$useremail,$phonenumber,$userpassword,$fullname);
if($query->execute() == true){
    session_start();
    $_SESSION['clientname'] = $firstname." ".$lastname;
    $_SESSION['clientmail'] = $useremail;
    $_SESSION['clientpass'] = $userpassword;
    $_SESSION['clientnum'] = $phonenumber;
    
    header("Location: clientdashboard.php"); /* Redirect to form */ 
    exit();
}
else {
    header("Location: http://localhost/vfdform/clientlogin/redirectloginpage.html"); /* Redirect to signin page if false */ 
    exit();
}
?>