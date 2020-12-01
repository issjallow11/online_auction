<?php
    session_start();
    require "admin/Database.php";
    if(isset($_SESSION['email']) && $_SESSION['type'] == "administrator"){
      header('Location: admin/index.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction | Online</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/custom.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>
  <?php require "common/nav.php" ?>

  <div class="container">
          <h1 class="text-center header-landing"><strong>Latest Items</strong></h1>
              <div class="row products">
                    <?php 
                        $db = Database::connect();
                        $sql = " SELECT * FROM products ORDER BY id_product DESC";
                              foreach ($db->query($sql) as $row){
                                echo '<div class="col-lg-4 col-md-4 col-sm-12">
                                  <div class="card">
                                  <img src="uploads/'.$row['image'].'" class="card-img-top" alt="'.$row['image'].'" style="height:224px;">
                                  <div class="card-body">
                                    <h5 class="card-title">'.$row['name_product'].'</h5>
                                    <p class="card-text">'.$row['description'].'</p>
                                    <p class="card-text"> Start Price: <strong>'.$row['price_product'].' GMD</strong></p>
                                  </div>
                                  <div class="card-footer">
                                    <a class="btn btn-primary btn-block" href="view.php?id='.$row['id_product'].'"><i class="fa fa-eye"></i> View</a>
                                  </div>
                                  </div>
                                </div>';   
                              }
                          
                          Database::disconnect();
                        ?>
            </div>
    </div>
    
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>