<?php
  session_start();
  if(!isset($_SESSION['email'])){
      header('Location: login.php');
  }
require "Database.php";
require "function.php";  
$nameError = $priceError = $categoryError = $imageError = $durationError = $name=$price=$description=$duration=$category=$image= "";

    if(!empty($_POST)){
      $name = checkInput($_POST['product_name']);
      $price = checkInput($_POST['price']);
      $description = checkInput($_POST['description']);
      $duration = checkInput($_POST['duration']);
      $category = checkInput($_POST['category']);
      $image =checkInput($_FILES['image']['name']);
      $valid_extensions = array('jpeg', 'jpg', 'png');
      $path = '../uploads/';
      $tmp = $_FILES["image"]["tmp_name"];
      $final_image = rand(1000,1000000).$image;
      $imagePath  = '../uploads/'. basename($final_image);
      $isSuccess = true;
      $isUploadSuccess = false;

      if(empty($name)){
        $nameError = "Please Enter Product Name!";
        $isSuccess = false;
      }
      if(empty($price)){
        $priceError = "Please Enter a starting price!";
        $isSuccess = false;
      }
      if(empty($duration)){
        $durationError = "Please the duration for bidding!";
        $isSuccess = false;
      }
      if(empty($category)){
        $categoryError = "Please Select a category!";
        $isSuccess = false;
      }
      if(empty($image)){
        $imageError = "Image is required. Please insert an image!";
        $isSuccess = false;
      }
      else{
        $isUploadSuccess = true;
        $ext = strtolower(pathinfo($image, PATHINFO_EXTENSION));
        if(file_exists($imagePath)){
            $imageError = "This image already exists!";
            $isUploadSuccess = false; 
        }
        if(in_array($ext, $valid_extensions)){ 
            $path = $path.strtolower($final_image);
            if(!move_uploaded_file($tmp,$path)){
                $imageError = "An error occured during image upload!";
                $isUploadSuccess = false; 
            }
           
            }else{
                $imageError = "The autorised extensions are: JPG, JPEG and PNG!";
                $isUploadSuccess = false;
            }
        
      }

      if($isSuccess && $isUploadSuccess){
       
          $db = Database::connect();
          $sql = "INSERT INTO products (product_name,price_product,description,duration,image,category) VALUES(?,?,?,?,?,?)";
          $stmt = $db->prepare($sql);
          $stmt->execute([$name,$price,$description,$duration,$final_image,$category]);
          header('Location: products.php');
          Database::disconnect();
        
      }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/custom.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/countrySelect.min.css" rel="stylesheet" type="text/css">
     
</head>
<body>
<div><?php require "../common/navadmin.php" ?></div>
<div class="container mt-5">
        <div class="card  shadow mb-4">
            <div class="card-header bg-primary py-3">
              <h6 class="m-0 mt-2 font-weight-bold text-white">Add Item</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="addItem.php" autocomplete="off" enctype="multipart/form-data">
                    
                    <div class="form-group row">
                          <label for="name" class="col-sm-2 col-form-label">Item Name</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control" id="product_name" name="product_name">
                          <span class="help-inline"><?php echo $nameError; ?></span>
                          </div>
                      </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                        <input type="text" class="form-control" id="price" name="price">
                        <span class="help-inline"><?php echo $priceError; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                        <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-sm-2"></div>
                      <div class="form-group col-md-5">
                        <input type="text" class="form-control" id="duration" placeholder="Bid duration ex: June 20,2020 01:00" name="duration">
                        <span class="help-inline"><?php echo $durationError; ?></span>
                      </div>
                      <div class="form-group col-md-5">
                        <select class="form-control" id="category" name="category">
                            <option value="">Choose Category</option>
                            <option value="antique">Antique</option>
                            <option value="costume">Costume</option>
                            <option value="chemise">Chemise</option>
                            <option value="autre">Autre</option>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                      </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image">
                        <span class="help-inline"><?php echo $imageError; ?></span>
                        </div>
                    </div>
                  
                    <div class="form-group row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 col-lg-10 clear-fix">
                        <button type="submit" class="btn btn-primary float-left" id="addItem" name="addItem">Add Item</button>
                        <a href="products.php" class="btn btn-danger float-right"><i class="fa fa-arrow-left"></i> return</a>
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
  <!-- Other plugin javascript -->
  <script src="../vendor/plugins/bootstrap-formhelpers.min.js"></script>
  <script src="../vendor/plugins/notify.min.js"></script>
  <script src="../vendor/plugins/countrySelect.min.js"></script>

  <script>
    $("#country").countrySelect({
            defaultCountry: "gm"
    });
  
</script>
</body>
</html>