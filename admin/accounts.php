<?php
    session_start();
    if(!isset($_SESSION['email'])){
        header('Location: login.php');
    }
    require "Database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accounts</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/custom.css" rel="stylesheet" type="text/css">
    <link href="../vendor/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Custom styles for this page -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
    <div><?php require "../common/navadmin.php" ?></div>

    <div class="container">
              <!-- DataTales Example -->
          <div class="card shadow mb-4 mt-5">
            <div class="card-header py-3 clear-fix">
              <h6 class="m-0 mt-2 font-weight-bold text-primary float-left">Accounts</h6>
              <a href="addAccount.php" class="btn btn-primary float-right"><span class="fa fa-user-plus"></span> Add User</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Address</th>
                      <th>Country</th>
                      <th>UserType</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                      $db = Database::connect();
                      $sql = " SELECT * FROM accounts";
                            foreach ($db->query($sql) as $row){
                                echo '<tr>'.
                                '<td>'.$row["fullName"].'</td>
                                <td>'.$row["email"].'</td>
                                <td>'.$row["address"] .'</td>
                                <td>'.$row["country"].'</td>
                                <td>'.$row["type"].'</td>
                                <td><a href="deleteUser.php" class="btn btn-danger btn-circle btn-lg text-white"> <i class="fas fa-trash"></i></a> <a href="blockUser.php" class="btn btn-info btn-circle btn-lg text-white"> <i class="fas fa-user-lock"></i></a></td>
                              </tr> '; 
                            }
                        
                        Database::disconnect();
                      ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>

 <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <script>
      $(document).ready(function() {
        $('#dataTable').DataTable();
      });
  </script>   
</body>
</html>