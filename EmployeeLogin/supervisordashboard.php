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
            margin-top: -10px;
            width: 98%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        a:link {
          text-decoration: none;
      }
      a:visited {
          text-decoration: none;
      }
     .table{
         margin-left: -8px;
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
      <li><a href="supactivity.php">View Your Verifications</a></li>
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
   <tr> <th>Full Name</th>
        <th>Phone Number</th>
        <th>Res. Address</th>
        <th>Office Address</th>
        <th>Occupation</th>
        <th>Duration</th>
        <th>Amount</th>
        <th>Amount Earned</th>
        <th>AccountName[Pay]</th>
        <th>BankName[Pay]</th>
        <th>Already vetted by</th>
        <th>Vet by <?php echo $_SESSION["employeename"];   ?></th>
    </tr>   
    </thead>
    <?php
         
        
        
            $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
           //fetch details of the client who has not benn verified by supervisor
            $query = "SELECT * FROM FIXEDDEPOSITDB WHERE ID IN (SELECT CustomerID FROM aodashboard) AND ID NOT IN (SELECT CustomerID FROM supdashboard);";
            
          
          
            $fdquery = $connection->query($query);
            while($row = $fdquery->fetch_assoc()){
             
              echo "<tr> <td>".$row['FullName']."</td><td>".$row['PhoneNumber']."</td> <td>".$row['HomeAddress']."</td><td>".$row['OfficeAddress']."</td><td>".$row['Occupation']."</td>";
              
            
            
              
            
              
               $query2 = "SELECT * FROM PAYOUTDB WHERE CustomerID = ".$row['ID'].";";
               $query3 = "SELECT * FROM PLACEMENTDB WHERE CustomerID = ".$row['ID'].";";
               $payquery = $connection->query($query2);
               $placement = $connection->query($query3);
               while($rowplace =  $placement->fetch_assoc()){
                   //calculate amount earned by client over the duration
                $int = ($rowplace['InterestRate']/100)* $rowplace['Amount'];
                $intscale =  (($int/365) * $rowplace['ProposedDuration']) + $rowplace['Amount'];
                echo "<td>".$rowplace['ProposedDuration']." Days"."</td><td>"."&#8358;".$rowplace['Amount']."</td><td>"."&#8358;".round($intscale,2)."</td>";
               
              }
              while ($rowpayout = $payquery->fetch_assoc()){
                echo "<td>".$rowpayout['AccNamePayout']."</td><td>".$rowpayout['BankNamePayout']."</td><td>".$row['AccountingOfficer']."</td><td> <button class='btn btn-default btn-sm'><a href='supdbinsert.php?id=".$row['ID']."&verified=verified'>Verify</a></button></td></tr>";

              }
            }
          
          
            
            
    ?>
    
    </table>
        
  </div> 
        </body>                    
</html>
