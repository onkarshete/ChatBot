<?php
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $logout_id = $_SESSION['unique_id'];
        if(isset($logout_id)){
            session_unset();
            session_destroy();
            header("location: ../login.php");
        }else{
            header("location: ../users.php");
        }
    }else{  
        header("location: ../login.php");
    }
?>