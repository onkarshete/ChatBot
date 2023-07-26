<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  if($_SESSION['admin'] == 1){
    header("location: dashboard.php");
  }
?>

<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="users">
      <header>
        <div class="content">
          <?php 
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$_SESSION['unique_id']}");
            if(mysqli_num_rows($sql) > 0){
              $row = mysqli_fetch_assoc($sql);
              $_SESSION['addc'] = 0;
              if($row['user_type'] == 'service')
                $_SESSION['addc'] = 1;
                $_SESSION['servicedb'] = $row['fname']."_commands";
            }
          ?>
          <img src="php/images/<?php echo $row['img']; ?>" onerror="this.src='php/images/Default.png'" alt="">
          <div class="details">
            <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
            <p><?php echo $row['about']; ?></p>
            <input class="user-active" type="text" value="<?php echo $row['unique_id']; ?>" hidden>
          </div>
        </div>
        <?php 
        if($_SESSION['addc'] == 1)
          echo '<a href="commands.php" class="logout">Commands</a>';
          else
          echo '<a href="edit.php" class="logout">Edit</a>';
        ?>
        <a href="php/logout.php" class="logout">Logout</a>
      </header>
      <br>
      <div class="users-list">
  
      </div>
    </section>
  </div>

  <script src="javascript/users.js"></script>

</body>
</html>
