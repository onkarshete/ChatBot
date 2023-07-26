<?php 
  session_start();
  include_once "php/config.php";
  $btn="";
  if(isset($_SESSION['unique_id'])){
    $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $btn = '<p><a href="chat.php?user_id='.$user_id.'" class="btn-share">Chat</a></p>';
  }else{
    $btn = '<p><a href="index.php" class="btn-share">Home</a></p>';
  }
?>
<?php include_once "header.php"; ?>
<link rel="stylesheet" href="info.css">
<body>
  <?php 
        $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");

        if (isset($_SESSION['unique_id']) && $_SESSION['unique_id'] == $user_id) {
          $btn = '<p><a href="index.php" class="btn-share">Home</a></p>';
        }
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
  ?>
  <div class="wrapper">
    <section class="chat-area">
      <header style="border-bottom: 1px solid #e6e6e6;">
        <div class="content" style="margin-top: 15px;">
          
          <span style="margin: 20px; font-size: 18px; font-weight: 500;">Share Profile</span>

        </div>
      </header>
      <div class="users-list">
        <div class="img-area">
      <div class="inner-area">
        <img src="php/images/<?php echo $row['img']; ?>" onerror="this.src='php/images/Default.png'" alt="">
      </div>
    </div>
    <div class="details">
    <span>Full Name</span>
    <p><?php echo $row['fname']. " " . $row['lname'] ?></p>
    <span>About</span>
    <p><?php echo $row['about'] ?></p>
    <span>Unique ID</span>
    <p><?php echo $row['unique_id'] ?></p>
    <?php echo $btn; ?>
  <?php 
    }else{
  ?>
  <div class="wrapper">
    <section class="chat-area">
      <header style="border-bottom: 1px solid #e6e6e6;">
        <div class="content" style="margin-top: 15px;">
          
          <span style="margin: 20px; font-size: 18px; font-weight: 500;">Share Profile</span>

        </div>
      </header>
      <div class="users-list">
    <div class="details">
    <div class="text">Profile Doesn't Exist</div><br>
    <p><a href="index.php" class="btn-share">Home</a></p>
  <?php 
  }
  ?>
  </div>
      </div>
      
    </section>
  </div>

</body>
</html>