<?php
session_start();
//ensure the client is logged in else redirect to login page
if((isset( $_SESSION['clientname']))  == false )
{
  header('Location: clientlogin.html');
  exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            max-width: 94%;
            margin-left: 3%;
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
        }
        #signout{
            padding-right: 10px;
            padding-top: 7px;
        }
        .container{
            background-color: #ECEBEB;
            margin-top: -20px;
            width: 94%;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
        #mission{
            text-align: center;
            padding-top: 40px;
            font-size: 30px;
            font-family: 'Raleway', sans-serif;
        }
        #who{
            padding-top: 200px;
            padding-left: 80px;
            
        }
        .whocontent{
            max-width: 450px;
            padding-left: 80px;
            text-align: justify;
            
        }
        #services{
            float: right;
            margin-top: -200px;
            padding-right: 340px;
        }
        .sercontent{
            float: right;
            margin-top: -150px;
            padding-right: 70px;
            max-width: 450px;
            text-align: justify;
        }
    </style>
</head>
<body>
<div id = "logo">
<img src = 'whitelogo.png' class="img-responsive"/>
    <p id = "welcome"> Welcome  <?php echo $_SESSION['clientname']; ?> !  </p>
</div> 

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"></a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Dashboard</a></li>
      <li><a href="activity.php">View Activity</a></li>
      <li><a href="Vfdform.php">Fixed Deposit Placement</a></li>
     

      
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li id = "signout"> 
     <form action = "clientsignout.php">  
     <button class="btn btn-default btn-sm">
      <span class="glyphicon glyphicon-log-out"></span> Log out
    </button>
    </form>
    </li>
    
    </ul>
  </div>
</nav>
  
<div class="container">
  <h3 id = "mission"><b>Our vision</b> is to become the foremost financial solutions brand in Africa.<br></h3>
    <h4 id = "who"><b>Who we are.</b></h4><br>
    <p class = "whocontent"><b>VFD Group</b> is a financial services focused proprietary investment company that creates value by working within Nigeria’s informal financial sector to create innovative products and solutions.<br>
    <b>Our goal at VFD Group</b> is to have established a firm foothold in various ecosystems on the continent through our subsidiary companies by the year <b>2018.</b> </p>
    <div class = "services">
    <h4 id = "services"><b>Our Services.</b></h4>
    <p class = "sercontent">We developed a business model that allows us to operate in every area of the financial industry through our subsidiaries, providing Financial Advisory, Asset Management, Currency, Real Estate, Debt Services and Private Funds Management Services, taking deposits and providing loans at very competitive rates.</p>
    </div>
</div>

</body>
</html>
