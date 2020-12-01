<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Auction</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <?php
            if(isset($_SESSION['email'])){
              echo '<li class="nav-item">
              <a class="nav-link" href="messages.php">Messages</a>
              </li>
              <li class="nav-item">
              <a class="nav-link" href="settings.php">Settings</a>
              </li>
              ';
            }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          <?php
          if(isset($_SESSION['email'])){
            echo '<li class="nav-item">
            <a class="nav-link" href="admin/logout.php">Logout</a>
            </li>';
          }
          else{
            echo '<li class="nav-item">
            <a class="nav-link" href="admin/login.php">Signin</a>
            </li>';
          }
          ?>
        </ul>
      </div>
    </div>

    <?php
          if(isset($_SESSION['email'])){
            echo '<span clas="float-right mr-0" style="color:#fff;"><i class="fa fa-user"></i>, '.$_SESSION['name'].'</span>';
          }
    ?>
  </nav>