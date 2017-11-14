<?php
session_start();
//check if the user is logged in and if not, redirect to login page
if((!isset($_SESSION['clientmail'])) && (!isset($_SESSION['clientpass'])))
{
  header('Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/ClientLoginAssignment/clientlogin.html');
  exit();
}


?>

<html>
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
  </head>
  <style>
    .container{
      background-color: #ECEBEB;
      padding: 10px;
      margin-top: 70px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    h3{
      text-align: center;
      font-size: 30px;
      font-weight: 600;
    }
    #logo {
      background-color: #25215f;
  }
  #logo img {
      max-width: 150px;
      padding-top: 15px;
      padding-left: 20px;
  }
  #welcome{
      padding-left: 40px;
      font-size: 25px;
      font-weight: 500;
      color: #E4DFFB;
      font-family: 'Ubuntu', sans-serif;
  }
body{ 
      font-family: 'Rubik', sans-serif;
  }
.btn{
      font-size: 20px;
      margin-left: 85%;
      margin-top: -60px;
  }
  h4{
    padding-left: 30px;
  }
  </style>
<body>

<div id = "logo">
<img src = 'whitelogo.png' class="img-responsive"/>
    <p id = "welcome"> Dear  <?php  echo $_SESSION['clientname']; ?> !  </p>
    
    <form action = "clientdashboard.php">  
     <button class="btn btn-default btn-sm">
       <h5><b>Back to Dashboard</b></h5>
    </button>
    </form>
</div>  
<h3> View all your Fixed Deposit Placements with us!</h3> 
<?php  
//query database to fetch the fullname of the client
  $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
  $query1 = "SELECT AccountingOfficer  FROM FIXEDDEPOSITDB WHERE FullName = '".$_SESSION['clientname']."';";
  $queryao = $connection->query($query1);
  $fetchao = $queryao->fetch_assoc();
    ?>
<h4> Your Account Officer is <?php echo $fetchao['AccountingOfficer']."."; ?> </h4>
<h4> Contact Details: <?php 
//fetch and display the phonenumber of the account officer
     $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
    $query = "SELECT PhoneNumber FROM EMPLOYEEDB WHERE FullName = '".$fetchao['AccountingOfficer']."';";
    $querynum = $connection->query($query);
    $fetchnum = $querynum->fetch_assoc();
    echo $fetchnum['PhoneNumber'].".";
?>
<div class = "container">
<table class="table table-bordered">
    <thead>
   <tr>
        <th>Duration</th>
        <th>Amount</th>
        <th>Interest Rate</th>
        <th>Amount Expected</th>
        <th>AccountNo [Payout]</th>
        <th>AccountName [Payout]</th>
        <th>BankName [Payout]</th>
  
        
  </tr>   
    </thead>
<?php
//fetch the customer ID 
$connection = new mysqli('localhost','root','Stoneage1992.','vfd');
$query = "SELECT ID FROM FIXEDDEPOSITDB WHERE '".$_SESSION['clientname']."' = FullName;";


$namequery = $connection->query($query);
while($custid = $namequery->fetch_assoc()){
//update the interest rate column on the placementdb table
$query4 = "UPDATE placementdb SET InterestRate = (SELECT Rates FROM rates WHERE TenorID = (SELECT ID FROM interesttenor WHERE placementdb.ProposedDuration BETWEEN MinimumDays AND MaximumDays)  AND DepositID = (SELECT ID FROM interestdeposit WHERE placementdb.Amount BETWEEN MinimumDeposit AND MaximumDeposit));";
$interest = $connection->query($query4);
//fetch the placement and payout details of the customer from the placementdb and payoutdb table
$query2 = "SELECT * FROM PLACEMENTDB WHERE CustomerID = ".$custid['ID'].";";
$query3 = "SELECT * FROM PAYOUTDB WHERE CustomerID =".$custid['ID'].";";


$placequery = $connection->query($query2);
$payquery = $connection->query($query3);
while ($place = $placequery->fetch_assoc()){
  $int = ($place['InterestRate']/100)* $place['Amount'];
  $intscale =  (($int/365) * $place['ProposedDuration']) + $place['Amount'];
  echo "<tr> <td>".$place['ProposedDuration']." Days"."</td><td>"."&#8358;".$place['Amount']."</td><td> ".$place['InterestRate']."%"."</td><td>"."&#8358;".round($intscale,2)."</td>";
    while ($pay = $payquery->fetch_assoc()){
      echo "<td>".$pay['AccNoPayout']."</td><td> ".$pay['AccNamePayout']."</td><td> ".$pay['BankNamePayout']."</td></tr>";
    }
}

}

?>

</div>