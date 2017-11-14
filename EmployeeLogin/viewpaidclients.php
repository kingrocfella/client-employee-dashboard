<?php
session_start();
if((isset($_SESSION['employeeloginemail'])) &&(isset($_SESSION['employeeloginpass'])) == false )
{
  header('Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/EmployeeLogin/Employee.html');
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
  </head>
  <body>
  <div id = "logo">
<img src = 'whitelogo.png' class="img-responsive"/>
    <p id = "welcome"> Dear  <?php  echo $_SESSION["employeename"]; ?> !  </p>
    
    <form action = "treasurydashboard.php">  
     <button class="btn btn-default btn-sm">
       <h5><b>Back to Dashboard</b></h5>
    </button>
    </form>
</div>  
<h3> View all Paid Transactions!</h3>
<div class = "container">
    <table class="table table-bordered">
    <thead>
   <tr> <th>Full Name</th>
        <th>Phone Number</th>
        <th>Duration</th>
        <th>Amount Paid</th>
        <th>AccountNumber[Payout]</th>
        <th>AccountName[Payout]</th>
        <th>BankName[Payout]</th>
        <th>Paid by</th>
        <th>Date of Payment</th>
        
    </tr>   
    </thead>
    <?php
         
        
        
            $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
            // fetch the details of the client that has been paid by treasury.
            $query = "SELECT * FROM FIXEDDEPOSITDB WHERE ID IN (SELECT CustomerID FROM treasurydashboard);";
            $fdquery = $connection->query($query);
            while($row = $fdquery->fetch_assoc()){
             
              echo "<tr> <td>".$row['FullName']."</td><td>".$row['PhoneNumber']."</td>";
               $query2 = "SELECT * FROM PAYOUTDB WHERE CustomerID = ".$row['ID'].";";
               $query3 = "SELECT * FROM PLACEMENTDB WHERE CustomerID = ".$row['ID'].";";
               $payquery = $connection->query($query2);
               $placement = $connection->query($query3);
               while($rowplace =  $placement->fetch_assoc()){
                $int = ($rowplace['InterestRate']/100)* $rowplace['Amount'];
                $intscale =  (($int/365) * $rowplace['ProposedDuration']) + $rowplace['Amount'];
                echo "<td>".$rowplace['ProposedDuration']." Days"."</td><td>"."&#8358;".round($intscale,2)."</td>";
                $query4 = "SELECT * FROM treasurydashboard WHERE CustomerID = ".$row['ID'].";";
                $trquery = $connection->query($query4);
                while ($rowtr = $trquery->fetch_assoc()){
              
              while ($rowpayout = $payquery->fetch_assoc()){
                echo "<td>".$rowpayout['AccNoPayout']."</td><td>".$rowpayout['AccNamePayout']."</td><td>".$rowpayout['BankNamePayout']."</td><td>".$rowtr['CashierName']."</td><td>".$rowtr['DateOfPayment']."</td></tr>";

              }
            }
        }
    }
          
            
            
    ?>
    
    </table>
            
            </div> 
            </body>                     
</html>
