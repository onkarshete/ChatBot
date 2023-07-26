<?php 
  session_start();
  $msg = "";
  include_once "config.php";
  if($_SESSION['admin'] != 1){
    header("location: ../login.php");
  }
  else{
    if(isset($_GET['did']) && isset($_GET['type'])){
        echo $sql;
        $did = $_GET['did'];
        $ut = $_GET['user_type'];
        $sql = mysqli_query($conn, "DELETE FROM users WHERE unique_id = {$did} and user_type = 'user'");
        $sql = mysqli_query($conn, "DELETE FROM messages WHERE incoming_msg_id = {$did} or outgoing_msg_id = {$did}");
        header("Location: ../dashboard.php");
        exit();
    }
    else{
        header("Location: ../dashboard.php");
    }
}
?>
