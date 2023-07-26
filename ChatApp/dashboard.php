<?php 
  session_start();
  include_once "php/config.php";
  if($_SESSION['admin'] != 1){
    header("location: login.php");
  }
  $_SESSION['addc'] == 0;
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <a href="dashboard.php?type=user" class="btn">Users</a> 
        <a href="dashboard.php?type=service" class="btn">Services</a>
        <a href="php/logout.php?type=user" class="btn">Logout</a> 
      </header>
      <?php
          if(!isset($_GET['type'])){
            $_SESSION['type'] = "user";
          }else{
            $_SESSION['type'] = mysqli_real_escape_string($conn, $_GET['type']);
          }
          
          //$_SESSION['type'] = 'user';
      ?>
      <div class="users-list">
    
      </div>
      <?php
          if($_SESSION['type']=="service"){
            echo '<br>
            <div style="display: flex; justify-content: center;">
            <a class="btn" href="addservice.php">Add Service</a>
            </div>';
          }
      ?>
    </section>
  </div>

  <script src="javascript/admin.js"></script>

</body>
</html>
