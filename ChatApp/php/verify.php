<?php
    include_once "config.php";
    $token = mysqli_real_escape_string($conn, $_POST['token']);
    if(!empty($token)){
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email_verify = '{$token}'");
        if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
            $sql2 = mysqli_query($conn, "UPDATE users SET email_verify = 1 WHERE email = '{$row['email']}'");
            if($sql2){
                echo "success";
            }else{
                echo "Something went wrong. Please try again!";
            }
        }else{
            echo "Invalid Verification Link!<br> or <br>Email is Already Verified";
        }
    }else{
        echo "Invalid Verification Token!";
    }
?>