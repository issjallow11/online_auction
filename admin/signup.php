<?php
require "Database.php";
require "function.php";  
$nameError = $emailError = $passwdError = $name=$email=$passwd=$address=$country=$message= "";

    if(!empty($_POST)){
      $name = checkInput($_POST['fullname']);
      $email = checkInput($_POST['email']);
      $passwd = checkInput($_POST['password']);
      $address = checkInput($_POST['address']);
      $country = checkInput($_POST['country']);
      $isSuccess = true;

      if(empty($name)){
        $nameError = "Please Enter Your Name!";
        $isSuccess = false;
      }
      if(empty($email)){
        $emailError = "Please Enter an email!";
        $isSuccess = false;
      }
      if(empty($passwd)){
        $passwdError = "Please Enter a password!";
        $isSuccess = false;
      }
      else{
        if(strlen($passwd) < 8){
          $passwdError = "Password cannot be less than 8 characters!";
          $isSuccess = false;
        }
      }

      if($isSuccess){
        $verify_email = verify_email($email);
        if($verify_email != null) {
            echo '<script>alert("This Account already exists");</script>';
        }
        else{
          $db = Database::connect();
          $password = password_hash($passwd, PASSWORD_DEFAULT);
          $type = "user";
          $status = 1;
          $sql = "INSERT INTO accounts (fullName,email,password,address,country,type,status) VALUES(?,?,?,?,?,?,?)";
          $stmt = $db->prepare($sql);
          $stmt->execute([$name,$email,$password,$address,$country,$type,$status]);
          echo '<script>alert("Account Sucessfully Created!");</script>';
          header('Location: login.php');
          Database::disconnect();
        }
      }
    }


     function verify_email($email){
      $db = Database::connect(); 
      $sql = " SELECT email FROM accounts WHERE email=?";
      $stmt = $db->prepare($sql);
      $stmt->execute([$email]);
      $rowCount = $stmt->rowCount();
      if(!$rowCount) return null;
      return $rowCount;
      Database::disconnect();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/custom.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/countrySelect.min.css" rel="stylesheet" type="text/css">
     <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Other plugin javascript -->
  <script src="../vendor/plugins/bootstrap-formhelpers.min.js"></script>
  <script src="../vendor/plugins/notify.min.js"></script>
  <script src="../vendor/plugins/countrySelect.min.js"></script>
</head>
<body>
<div class="container">
        <div class="card mt-10">
          <div class="card-header bg-primary">
              <h1 class="text-center">Sign Up</h1>
          </div>
            <div class="card-body">
                <form method="POST" action="signup.php" autocomplete="off">
                  
                    <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control" id="fullname" name="fullname">
                          <span class="help-inline"><?php echo $nameError; ?></span>
                          </div>
                      </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email">
                        <span class="help-inline"><?php echo $emailError; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password">
                        <span class="help-inline"><?php echo $passwdError; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-sm-2"></div>
                      <div class="form-group col-md-5">
                        <input type="text" class="form-control" id="Address" placeholder="Address" name="address">
                      </div>
                      <div class="form-group col-md-5">
                        <input type="text" class="form-control" id="country" name="country">
                      </div>
                      </div>
                  
                    <div class="form-group row">
                    <div class="col-sm-2"></div>
                        <div class="col-sm-10 col-lg-10 d-flex flex-column justify-content-center">
                        <button type="submit" class="btn btn-primary" id="signup" name="create_account">Sign Up</button>
                        <span class="text-muted text-center">Already have an Account? <a href="login.php" class="text-center">Signin</a></span>
                        <a href="../index.php" class="text-center">Go to Homepage</a>
                        </div>
                    </div>
                    
            </form>
            </div>
        </div>
    </div>


  <script>
    $("#country").countrySelect({
            defaultCountry: "gm"
    });
  
</script>
</body>
</html>