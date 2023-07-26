<?php 
  session_start();
  include_once "php/config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
?>
<?php include_once "header.php"; ?>
<body>
  <div class="wrapper">
    <section class="chat-area">
      <?php 
          $user_id = mysqli_real_escape_string($conn, $_GET['user_id']);
          $_SESSION['autochat'] = 0;
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'service'");
          if(mysqli_num_rows($sql) > 0){
              $servicelist = array();
              while($row = mysqli_fetch_assoc($sql)){
                  array_push($servicelist,$row['unique_id']);
              }
          }
          if(in_array($user_id, $servicelist)){
              $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
              if(mysqli_num_rows($sql2) > 0){  
                  $row = mysqli_fetch_assoc($sql2);
                  $_SESSION['servicedb'] = $row['fname']."_commands";
                  $database = $row['fname'].'_commands';
              }
              $sql3 = "SELECT * FROM {$database} WHERE command_msg = 00";
              $query3 = mysqli_query($conn, $sql3);
              if(mysqli_num_rows($query3) > 0){
                while($row3 = mysqli_fetch_assoc($query3)){
                  $msg = $row3['command_reply'];
                }
                mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$_SESSION['unique_id']}, {$user_id}, '{$msg}', 'text', now(), 0)") or die();
              }
              $chk = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
              if(mysqli_num_rows($chk) <= 0){
                header("location: users.php");
              }
          }
          $sql4 = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'service'");
          if(mysqli_num_rows($sql4) > 0){
              $servicelist2 = array();
              while($row = mysqli_fetch_assoc($sql4)){
                  array_push($servicelist2,$row['unique_id']);
              }
          }
          if(!in_array($user_id, $servicelist)){
              $duser = $_SESSION['unique_id'];
              $sql5 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$duser}");
              if(mysqli_num_rows($sql5) > 0){  
                  $row = mysqli_fetch_assoc($sql5);
                  $_SESSION['servicedb'] = $row['fname']."_commands";
                  $database = $row['fname'].'_commands';
              }
          $chk = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($chk) <= 0){
            header("location: users.php");
          }
          }
        ?>
        <input class="user-active" type="text" value="<?php echo $_SESSION['unique_id']; ?>" hidden>
      <header class="header-info">
    
      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <label for="image-att"><i class="fas fa-paperclip" style="margin-top: 12px;margin-right: 15px;"></i></label>
        <input type="file" id="image-att" name="image-att" accept="image/x-png,image/gif,image/jpeg,image/jpg">
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
