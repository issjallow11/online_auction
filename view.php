<?php
session_start();
require "admin/Database.php";
require "admin/function.php";
    if(!empty($_GET['id'])){
        $id = checkInput($_GET['id']);
        $db = Database::connect();
        $sql = " SELECT * FROM product WHERE id_product= ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        Database::disconnect();
    }
    $bidError = "";
    
    if(isset($_POST['submitBid'])){
        if(isset($_SESSION['email']) && $_SESSION['type'] == "user"){
            $isSuccess = true;
            if(!empty($_POST)){
            $amount = checkInput($_POST['bid_amount']);
            if(empty($amount)){
                $bidError = "Please Enter an amount to Bid!";
                $isSuccess = false;
            }
            else{
                if($amount < $item['price_product']){
                    $bidError = "Your Bid cannot be less than the starting Price!";
                    $isSuccess = false; 
                }
            }

            if($isSuccess){
                $db = Database::connect();
                $sql = "INSERT INTO bids (id_product,id_login,price_bid) VALUES(?,?,?)";
                $stmt = $db->prepare($sql);
                $stmt->execute([$item['id_product'],$_SESSION['_id'],$amount]);
                header('Location: view.php?id='.$id.'');
                Database::disconnect();
            }

        }
        }
        else{
            $bidError = "Please login or create and Account to Bid!";
        }
        

    }

    $db = Database::connect();
    $sql = 'SELECT MAX(price_bid) AS price_bid FROM bids WHERE id_product=? GROUP BY id_product ORDER BY id_bid ASC LIMIT 1';
    $stmt = $db->prepare($sql);
    $stmt->execute([$item['id_product']]);
    $bids = $stmt->fetch();
    Database::disconnect(); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Bid</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/css/custom.css" rel="stylesheet" type="text/css">
    <link type="text/css" rel="stylesheet" href="vendor/clock_assets/flipclock.css" />
     
</head>
<body>
<?php require "common/nav.php" ?>
        <div class="container">
            <div class="card mt-10 shadow mb-4 bid-card">
                <div class="card-header bg-primary py-3">
                <h6 class="m-0 mt-2 font-weight-bold text-center">Item Details</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row no-gutters">
                                    <div class="col-md-4">
                                    <img src="/uploads/<?php echo $item['image'] ?>" class="card-img" alt="<?php echo $item['product_name'] ?>">
                                    </div>
                                    <div class="col-md-8">
                                    <div class="card-body">
                                        <?php
                                             $db = Database::connect();
                                             $sql = 'SELECT MAX(price_bid) AS current_price FROM bids WHERE id_product=?';
                                             $stmt = $db->prepare($sql);
                                             $stmt->execute([$item['id_product']]);
                                             $result = $stmt->fetch();
                                             Database::disconnect();  
                                        ?> 
                                        <p>Product Name: <?php echo $item['product_name'];?></p> 
                                        <p>Start Price: <?php echo $item['price_product'];?> <strong>GMD</strong></p>
                                        <p>Current Price: <?php if($result['current_price'] != null)echo $result['current_price'];else echo $item['price_product'];?> <strong>GMD</strong></p>
                                        <p>Description: <?php echo $item['description'];?></p>
                                        <p>Category: <?php echo $item['category'];?></p>
                                        <a href="index.php" class="btn btn-danger btn-block"><i class="fa fa-arrow-left"></i> Return</a>
                                    </div>
                                    </div>
                                </div>
                                </div>
                        </div>
                        <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><strong>Countdown Timer</strong></h5>
                                <dd class="clock-builder-output" id="countdown"></dd><hr>
                                <form action="view.php?id=<?php echo $id; ?>" method="post">
                                    <div class="form-group">
                                    <input type="text" class="form-control" name="bid_amount" id="bid_amount" placeholder="Enter Amount to Bid">
                                    <span class="help-inline"><?php echo $bidError; ?></span>
                                    </div>
                                    <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block" id="submitBid" name="submitBid">Place Bid</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>

    <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Other plugin javascript -->
  <script src="vendor/plugins/bootstrap-formhelpers.min.js"></script>
  <script src="vendor/plugins/notify.min.js"></script>
  <script type="text/javascript" src="vendor/clock_assets/flipclock.js"></script>

    <script>
        $(document).ready(function(){
            // Set the date we're counting down to
			var countDownDate = new Date("<?php echo $item['duree'] ?>").getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

            // Get todays date and time
            var now = new Date().getTime();

            // Find the distance between now an the count down date
            var distance = countDownDate - now;

            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("countdown").innerHTML = days + " Days " + hours + "Hrs "
            + minutes + "Mins " + seconds + "Secs";

            // If the count down is finished, write some text 
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("countdown").innerHTML = "Bidding is closed!";
                document.getElementById("submitBid").disabled = true;
                let id_produit = "<?php echo $item['id_produit']; ?>"
                let prix_bid = "<?php echo $bids['prix_bid']; ?>"
                let id_login = "<?php  if(isset($_SESSION['_id'])) echo $_SESSION['_id'];else echo "null"; ?>"
                $.ajax({
                    method:"POST",
                    url:"bidClose.php",
                    data:{'id_product':id_produit,'price_bid':price_bid,'id_login':id_login},
                    success: function(data){
                            if(id_login != "null"){
                                $('#countdown').append('<p style="color:green;">Please check your messages to see if you have won the Bid!</p>');
                            }
                    },
                    error:function(err){
                        console.log(err.responseText);
                    }
                });
                     
            }
            }, 1000);
        });
                        
    </script>
</body>
</html>