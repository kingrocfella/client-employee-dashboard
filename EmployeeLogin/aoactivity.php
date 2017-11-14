<?php
session_start();
//redirect employee to loginpage if not logged in
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
  <div id = "logo">
<img src = 'whitelogo.png' class="img-responsive"/>
    <p id = "welcome"> Dear  <?php  echo $_SESSION["employeename"]; ?> !  </p>
    
    <form action = "AccountOfficerdashboard.php">  
     <button class="btn btn-default btn-sm">
       <h5><b>Back to Dashboard</b></h5>
    </button>
    </form>
</div>  
<h3> View all your Verifications!</h3>
<div class = "container">
<table class="table table-bordered">
    <thead>
   <tr>
   <th>Full Name</th>
   <th>Phone Number</th>
   <th>Res. Address</th>
   <th>Office Address</th>
   <th>Occupation</th>
   <th>Duration</th>
   <th>Amount</th>
   <th>Interest Rate</th>
   <th>AccountNo</th>
   <th>AccountName</th>
   <th>BankName</th>     
  </tr>   
    </thead>
    <?php
         
        
        
            $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
           //Fetch client details which has been verified by the account officer
            $query = "SELECT * FROM FIXEDDEPOSITDB WHERE AccountingOfficer = '".$_SESSION["employeename"]."' AND ID IN (SELECT CustomerID FROM aodashboard);";
            $query4 = "UPDATE placementdb SET InterestRate = (SELECT Rates FROM rates WHERE TenorID = (SELECT ID FROM interesttenor WHERE placementdb.ProposedDuration BETWEEN MinimumDays AND MaximumDays)  AND DepositID = (SELECT ID FROM interestdeposit WHERE placementdb.Amount BETWEEN MinimumDeposit AND MaximumDeposit));";
            $interest = $connection->query($query4);
            $fdquery = $connection->query($query);
            while($row = $fdquery->fetch_assoc()){
             
              echo "<tr> <td>".$row['FullName']."</td><td>".$row['PhoneNumber']."</td> <td>".$row['HomeAddress']."</td><td>".$row['OfficeAddress']."</td><td>".$row['Occupation']."</td>";
                
               $query2 = "SELECT * FROM PAYOUTDB WHERE CustomerID = ".$row['ID'].";";
               $query3 = "SELECT * FROM PLACEMENTDB WHERE CustomerID = ".$row['ID'].";";
            
               $payquery = $connection->query($query2);
               $placement = $connection->query($query3);
               
               while($rowplace =  $placement->fetch_assoc()){
                echo "<td>".$rowplace['ProposedDuration']." Days"."</td><td>"."&#8358;".$rowplace['Amount']."</td><td>".$rowplace['InterestRate'].'%'."</td>"; 
                
              
              while ($rowpayout = $payquery->fetch_assoc()){
                echo "<td>".$rowpayout['AccNoPayout']."</td><td>".$rowpayout['AccNamePayout']."</td><td>".$rowpayout['BankNamePayout']."</td></tr>";

              }
            }
          }
          
            
            
    ?>
    
    </table>
        
  </div>                    
</html>
