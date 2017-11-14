<?php
session_start();
//check if the client is logged in
if((!isset($_SESSION['clientmail'])) && (!isset($_SESSION['clientpass'])))
{
  header('Location: http://localhost/vfdform/vfd-fixed-deposit-kingrocfella/ClientLoginAssignment/clientlogin.html');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>VFD FixedDeposit Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
 
  
  <script>
   
   $(document).ready(function validate(){
    //velidate the form
    $("#mainform").submit(function(){
        var f1= $("#fullname").val();
        var f3= $("#phonenumber1").val();
        var f4= $("#resaddr").val();
        var f5= $("#offaddr").val();
        var f6= $("#occupation").val();
        var f7= $("#duration").val();
        var f8= $("#amount").val();
        var f9= $("#accpayout").val();
        var f10= $("#accnamepayout").val();
        var f11= $("bankname").val();
        var f12= $("#kinname").val();
        var f13= $("#kinphonenumber").val();

       if (!isNaN(f1)){
            $("#err1").empty();
            $("#err1").append("Numeric digits are not allowed!");
            return false;
        }
        else {
          $("#err1").empty();
        }
         if (isNaN(f3)){
            $("#err2").empty();
            $("#err2").append("Only Numeric digits are allowed!");
            return false;
        }
        else {
          $("#err2").empty();
        }
        if (!isNaN(f4)){
            $("#err3").empty();
            $("#err3").append("Numeric digits are not allowed!");
            return false;
        }
        else {
          $("#err3").empty();
        }
        if (!isNaN(f5)){
            $("#err4").empty();
            $("#err4").append("Numeric digits are not allowed!");
            return false;
        }
        else{
          $("#err4").empty();
        }
        if (!isNaN(f6)){
            $("#err5").empty();
            $("#err5").append("Numeric digits are not allowed!");
            return false;
        }
        else{
          $("#err5").empty();
        }
        if (isNaN(f7)){
            $("#err6").empty();
            $("#err6").append("Only Numeric digits are allowed!");
            return false;
        }
        else if (f7 > 360 || f7 < 30){
            $("#err6").empty();
            $("#err6").append("Please enter a number between 30 - 360!");
            return false;
        }
        else{
          $("#err6").empty();
        }
        if (isNaN(f8)){
            $("#err7").empty();
            $("#err7").append("Only Numeric digits are allowed!");
            return false;
        }
        else{
          $("#err7").empty();
        }
         if (isNaN(f9)){
            $("#err8").empty();
            $("#err8").append("Only Numeric digits are allowed!");
            return false;
        }
        else{
          $("#err8").empty();
        }
        if (!isNaN(f10)){
            $("#err9").empty();
            $("#err9").append("Numeric digits are not allowed!");
            return false;
        }
        else{
          $("#err9").empty();
        }
        if (!isNaN(f11)){
            $("#err10").empty();
            $("#err10").append("Numeric digits are not allowed!");
            return false;
        }
        else{
          $("#err10").empty();
        }
        if (!isNaN(f12)){
            $("#err11").empty();
            $("#err11").append("Numeric digits are not allowed!");
            return false;
        }
        else{
          $("#err11").empty();
        }
        if (isNaN(f13)){
            $("#err12").empty();
            $("#err12").append("Only Numeric digits are allowed!");
            return false;
        }
        else{
          $("#err12").empty();
        }
    }); 

});
  // -- end--
  //-- validate number fields--

    </script>
    
</head>
<body>
    <div class = "container blue-bg">
            <div class= "col-xs-12 logo"><img src = "logo.jpg" class="img-responsive"> </div>
                <div class = "fdf">FIXED DEPOSIT PLACEMENT FORM</div>
    </div>
    <div class= "container thankyou"><p>Thank you for choosing to invest with VFD Bridge. We are pleased to have the opportunity to offer     our services to you.<br>
        Kindly provide ALL your details below (as applicable) to aid the processing of your placement.</p>
    </div>
    <div class="container main">
            <form class="form-horizontal" id = "mainform" action="main.php" method="POST">
              <div class="form-group">
                <label class="control-label col-sm-2" for="FullName"style="text-align:left;">FullName:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fullname" value= "<?php echo $_SESSION['clientname'];   ?> " name="FullName" readonly>
                  <span id = "err1" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="phonenumber1"style="text-align:left;">Phone Number:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="phonenumber1" value= "<?php echo $_SESSION['clientnum'];?>" name="phonenumber">
                  <span id = "err2" style ="color: #AE0000;"></span><span id = "numb" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="resaddr"style="text-align:left;">Residential Address:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="resaddr" placeholder="Enter Residential Address" name="resaddr" style="height:50px;" required>
                  <span id = "err3" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="offaddr"style="text-align:left;">Office Address:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="offaddr" placeholder="Enter Office Address" name="offaddr" style="height:50px;" required>
                  <span id = "err4" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="occupation"style="text-align:left;">Occupation:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="occupation" placeholder="Enter Occupation" name="occupation" required>
                  <span id = "err5" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class = "container title">
                <p>PLACEMENT INFORMATION</p>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-4" for="duration"style="text-align:left;">Proposed Duration:</label>
                <div class="col-sm-8">          
                  <input type="text" class="form-control" id="duration" placeholder="Enter Proposed Duration" name="duration" required>
                  <span id = "err6" style ="color: #AE0000;margin-left:-100px;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="amount"style="text-align:left;">Amount:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="amount" placeholder="Enter Amount" name="amount" required>
                  <span id = "err7" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class = "container title">
                <p>PAYOUT DETAILS</p>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-3" for="accpayout"  style="text-align:left;">Account Number:</label>
                <div class="col-sm-9">          
                  <input type="text" class="form-control" id="accpayout" placeholder="Enter Account Number" name="accpayout" required>
                  <span id = "err8" style ="color: #AE0000;margin-left: -70px;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="accnamepayout"style="text-align:left;">Account Name:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="accnamepayout" placeholder="Enter Account Name" name="accnamepayout" required>
                  <span class = "err9" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="bankname"style="text-align:left;">Name Of Bank:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="bankname" placeholder="Enter Name Of Bank" name="bankname" required>
                  <span class = "err10" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class = "container title">
                <p>NEXT-OF-KIN DETAILS</p>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="kinname"style="text-align:left;">Name:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="kinname" placeholder="Enter Name" name="kinname" required>
                  <span class = "err11" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="phonenumber2"style="text-align:left;">Phone Number:</label>
                <div class="col-sm-10">          
                  <input type="text" class="form-control" id="kinphonenumber" placeholder="Enter Phone Number" name="kinphonenumber" required>
                  <span class = "err12" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="kinemail"style="text-align:left;">Email Address:</label>
                <div class="col-sm-10">          
                  <input type="email" class="form-control" id="kinemail" placeholder="Enter Email" name="kinemail">
                  <span class = "err1" style ="color: #AE0000;"></span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="reference"style="text-align:left;padding-right:0px;">Reference:</label>
                <label class="control-label col-sm-1" for="space" id = "whoreferred">(Who referred you to the company)</label>
                <div class="col-sm-9">          
                <select name= "referral" id= "reference" class="form-control" required>
                <option selected="selected" value="">-- Select your referral --</option>
                    <?php
                    //fetch the first and lastnames of all the employees
                        $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
                        $query = "SELECT FirstName,LastName From employeedb;";
                        $aoquery = $connection->query($query);
                        while($row = $aoquery->fetch_assoc()){
                            echo "<option value = '".$row['FirstName']." ".$row['LastName']."' >".$row['FirstName']." ".$row['LastName']."</option>";
                        }
                    ?>
                </select>
                </div>
                </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="ao" style="text-align:left;margin-right:0px;">Account Officer:</label>
                <label class="control-label col-sm-1" for="space" id = "whoreferred">(Choose an account officer)</label>
                <div class="col-sm-9">          
                <select name= "accountofficer" id= "ao" class="form-control" required>
                <option selected="selected" value="">-- Select an Account Officer --</option>
                    <?php
                    //fetch only the accounting officers 
                        $connection = new mysqli('localhost','root','Stoneage1992.','vfd');
                        $query = "SELECT FirstName,LastName From employeedb WHERE Position = 'Accounting Officer' ;";
                        $aoquery = $connection->query($query);
                        while($row = $aoquery->fetch_assoc()){
                            echo "<option value = '".$row['FirstName']." ".$row['LastName']."' >".$row['FirstName']." ".$row['LastName']."</option>";
                        }
                    ?>
                </select>
              </div>
              </div>
              <div class="form-group">        
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default" style="margin-top:40px; margin-left:35%;" onclick="validate()">Submit</button>
                
              </div>
            </form>
          </div>

</body>
</html>
