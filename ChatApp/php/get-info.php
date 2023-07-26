<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
          $user_id = mysqli_real_escape_string($conn, $_POST['header_id']);
          $sql = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$user_id}");
          $row = mysqli_fetch_assoc($sql);
          $now = new DateTime();
          $lastlog = new DateTime($row['last_log']);
          if ($lastlog->modify('+10 seconds') < $now) {
              $status = '<p style="color:red;">Offline Now</p>';
          }else{
              $status = '<p style="color:green;">Active Now</p>';
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="php/images/<?php echo $row['img']; ?>" onerror="this.src='php/images/Default.png'" alt="">
        <a style="text-decoration: none; color: #000;" href="info.php?user_id=<?php echo $user_id ?>">
          <div class="details">
          <span><?php echo $row['fname']. " " . $row['lname'] ?></span>
          <?php echo $status; ?>
        </div>
      </a>
      <div style="margin-left: 8%;">
       <?php
            if($_SESSION['addc'] == 0)
            echo '<a href="./chat.php?user_id='. $row['unique_id'] .'"" class="btn" >Autochat</a>';
          ?>
      </div>
    <?php
    }else{
        header("location: ../login.php");
    }
    ?>