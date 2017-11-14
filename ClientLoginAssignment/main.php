<?php
    session_start();
    //verify if the user is loggedin
    if((!isset($_SESSION['clientmail'])) && (!isset($_SESSION['clientpass'])))
    {
      header('Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/ClientLoginAssignment/clientlogin.html');
      exit();
    }

    $servername= "localhost";
    $username = "root";
    $password = "Stoneage1992.";
    $database = "vfd";

    $connection = new mysqli($servername,$username,$password,$database);
    //check connection
    if ($connection->connect_error){
        die("The connection failed   ".connect_error);
    }
    // init form variables
    $fullname = $_SESSION['clientname'];
    $phonenumber = $_POST["phonenumber"];
    $resaddr = $_POST["resaddr"];
    $offaddr = $_POST["offaddr"];
    $occupation = $_POST["occupation"];
    $duration = $_POST["duration"];
    $amount = $_POST["amount"];
    $accpayout = $_POST["accpayout"];
    $accnamepayout = $_POST["accnamepayout"];
    $bankname = $_POST["bankname"];
    $kinname = $_POST["kinname"];
    $kinphonenumber = $_POST["kinphonenumber"];
    $kinemail = $_POST["kinemail"];
    $referral = $_POST["referral"];
    $accountofficer = $_POST["accountofficer"];

     

    //inserting into fixeddepositdb
    $query = "INSERT INTO FIXEDDEPOSITDB (FullName, PhoneNumber, HomeAddress, OfficeAddress, Occupation,  NextOfKinName, NextOfKinPhoneNo,NextOfKinEmail,Referral, AccountingOfficer) VALUES('".$fullname."','".$phonenumber."','".$resaddr."','".$offaddr."','".$occupation."','".$kinname."','".$kinphonenumber."','".$kinemail."','".$referral."','".$accountofficer."');"; 
    //get the customerID
    if($connection->query($query) == true){
        $customerid = $connection->insert_id;
        
    }
    
    //inserting into payoutdb
    $query1 = "INSERT INTO PAYOUTDB(AccNoPayout, AccNamePayout, BankNamePayout, CustomerID) VALUES('".$accpayout."','".$accnamepayout."','".$bankname."',".$customerid.");";
    //get the payoutID
    if($connection->query($query1) == true){
        $payoutid = $connection->insert_id;
    }

    //inserting into placementdb
    $query2 = "INSERT INTO PLACEMENTDB(ProposedDuration, Amount, CustomerID, PayoutID) VALUES(".$duration.",'".$amount."',".$customerid.",".$payoutid.");";

    
    if($connection->query($query2) == true){
        session_start();
        $_SESSION['ao'] = $accountofficer;
        header("Location: formthanks.html");
    }
    else {
        echo "Error connecting to database".$connection->error;
    }

        $connection->close();
?>

<html>
<head>
</head>
<body>
<!-- redirect the client to the signout page after submitting the form -->
<form action = "http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/ClientLoginAssignment/clientsignout.php">
              <button> Log Out </button>

            </form>

</body>


</html>