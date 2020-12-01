<?php
session_start();
require "Database.php";
require "function.php";  
 $emailError = $passwdError =$email=$passwd=$message= "";

    if(!empty($_POST)){
      $email = checkInput($_POST['email']);
      $passwd = checkInput($_POST['password']);
      $isSuccess = true;

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
          $user = login($email);
          if($user != null){
            $pass_verif = password_verify($passwd, $user['password']);
            if ($user && $pass_verif){
                $_SESSION['name'] = $user['fullName'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['_id'] = $user['Id_login'];
                $_SESSION['type'] = $user['type'];
                if($user['type'] == 'user'){
                    header('Location: ../index.php');
                }
                else{
                    header('Location: index.php');
                }
            }
          }
          else{
              $message = "This Account does not exist. Sign up to create an Account!";
          }
          
      }
    }

     function login($email){
        $db = Database::connect();
        $sql = " SELECT * FROM accounts WHERE email=? AND status=?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$email,1]);
        $user = $stmt->fetch();
        if(!$user) return null;
        return $user;
        Database::disconnect();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/custom.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
    <h1 class="text-center"></h1>
        <div class="card mt-10">
        <div class="card-header bg-primary"><h3 class="card-title text-center">Login</h3></div>
            
            <div class="card-body">
                <form method="POST" action="login.php" autocomplete="off">
                    <div class="form-group row">
                          <div class="col-sm-10">
                          <span class="message"><?php echo $message; ?></span>
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
                        <div class="col-sm-10 col-lg-10 d-flex flex-column justify-content-center">
                        <button type="submit" class="btn btn-primary" id="login" name="signin">Sign in</button>
                        <span class="text-muted text-center">Don't have an Account? <a href="signup.php" class="text-center">SignUp</a></span>
                        <a href="../index.php" class="text-center">Go to Homepage</a>
                        </div>
                    </div>
                    
            </form>
            </div>
        </div>
    </div>


 <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>  
   <!-- custom javascript 
   <script src="js/auth.js"></script> -->
</body>
</html>