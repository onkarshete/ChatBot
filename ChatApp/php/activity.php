<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
          $user_id = mysqli_real_escape_string($conn, $_POST['userActive']);
          $sql = mysqli_query($conn, "UPDATE users SET last_log = now() WHERE unique_id = {$user_id}");
          if ($sql) {
            echo "Done";
          }
    }else{
        header("location: ../login.php");
    }
    ?>