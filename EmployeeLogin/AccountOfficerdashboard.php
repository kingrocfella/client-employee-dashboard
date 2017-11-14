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
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

  <style>
      #logo {
            background-color: #25215f;
        }
        #logo img {
            max-width: 150px;
            padding-top: 15px;
            padding-left: 20px;
        }
        #welcome{
            padding-left: 70%;
            font-size: 30px;
            font-weight: 500;
            color: #E4DFFB;
            font-family: 'Ubuntu', sans-serif;
        }
        .navbar{
            margin-top: -10px;
            max-width: 96%;
            margin-left: 2%;
            background-color: #0C0C0C;
            font-family: 'Oxygen', sans-serif;
            font-size: 16px;
            font-weight: 550;
           
        }
        .nav{
            padding-left: 50px;
            
        }
        body{
            
            font-family: 'Rubik', sans-serif;
        }
        .btn{
            font-size: 15px;
            padding-left: 10px;
            background-color: #ffffff;
           
        }
        #signout{
            padding-right: 10px;
            padding-top: 7px;
        }
        .container{
            background-color: #ECEBEB;
            margin-top: -20px;
            width: 96%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        a:link {
          text-decoration: none;
      }
      a:visited {
          text-decoration: none;
      }
     
      
  </style>
 
</head>
<body>
<div id = "logo">
<img src = 'whitelogo.png' class="img-responsive"/>
    <p id = "welcome"> Welcome  <?php echo $_SESSION["employeename"]; ?> </p>
</div> 
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Dashboard</a></li>
      <li><a href="aoactivity.php">View Your Verifications</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li id = "signout"> 
     <form action = "employeesignout.php">  
     <button class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-log-out"></span> Log out
    </button>
    </form>
    </li>
    
    </ul>
  </div>
</nav>
<div class="container">
    <table class="table table-bordered">
    <thead>
   <tr> 
     <th>Full Name</th>
        <th>Phone Number</th>
        <th>Res. Address</th>
        <th>Office Address</th>
        <th>Email Address</th>
        <th>Duration</th>
        <th>Amount</th>
        <th>Interest Rate</th>
        <th>AccountNo</th>
        <th>AccountName</th>
        <th>BankName</th>
        <th>Vetted by <?php echo $_SESSION["employeename"];   ?></th>
    </tr>   
    </thead>
    <?php
         
        
        
            $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
            //fetch client details which is not already in the accounting officer's dashboard 
            $query = "SELECT * FROM FIXEDDEPOSITDB WHERE AccountingOfficer = '".$_SESSION["employeename"]."' AND NOT ID IN (SELECT CustomerID FROM aodashboard);";
            //calculate and update the interest rate column 
            $query4 = "UPDATE placementdb SET InterestRate = (SELECT Rates FROM rates WHERE TenorID = (SELECT ID FROM interesttenor WHERE placementdb.ProposedDuration BETWEEN MinimumDays AND MaximumDays)  AND DepositID = (SELECT ID FROM interestdeposit WHERE placementdb.Amount BETWEEN MinimumDeposit AND MaximumDeposit));";
            $interest = $connection->query($query4);
          
            $fdquery = $connection->query($query);
            while($row = $fdquery->fetch_assoc()){
             
              echo "<tr> <td>".$row['FullName']."</td><td>".$row['PhoneNumber']."</td> <td>".$row['HomeAddress']."</td><td>".$row['OfficeAddress']."</td>";
                //fetch client payout, placement and email details
               $query2 = "SELECT * FROM PAYOUTDB WHERE CustomerID = ".$row['ID'].";";
               $query3 = "SELECT * FROM PLACEMENTDB WHERE CustomerID = ".$row['ID'].";";
                $query4 = "SELECT Email FROM CLIENTDB WHERE FullName ='".$row['FullName']."';";
                
                
               $payquery = $connection->query($query2);
               $placement = $connection->query($query3);
               $email = $connection->query($query4);
               while($rowplace =  $placement->fetch_assoc()){
                   while ($rowemail = $email->fetch_assoc()){
                echo "<td>".$rowemail['Email']."</td><td>".$rowplace['ProposedDuration']." Days"."</td><td>"."&#8358;".$rowplace['Amount']."</td><td>".$rowplace['InterestRate'].'%'."</td>"; 
                
              
              while ($rowpayout = $payquery->fetch_assoc()){
                echo "<td>".$rowpayout['AccNoPayout']."</td><td>".$rowpayout['AccNamePayout']."</td><td>".$rowpayout['BankNamePayout']."</td><td> <button class='btn btn-default btn-sm'><a href='aodbinsert.php?id=".$row['ID']."&verified=verified'>Verify</a></button></td></tr>";

              }
            }
          }
           
        }
            
          
    ?>
    
    </table>
        
  </div>   
        </body>                 
</html>
