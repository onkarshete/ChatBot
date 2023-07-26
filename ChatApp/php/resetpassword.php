<?php 
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if(!empty($email)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                $password = substr($row['password'], 0, 12);
                $fname = $row['fname'];
                $lname = $row['lname'];
                $tmp_pass = md5($password);
                $sql2 = mysqli_query($conn, "UPDATE users SET password = '{$tmp_pass}' WHERE unique_id = {$row['unique_id']}");
                if($sql2){
                    include_once "resetmail.php";
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }else{
                echo "$email - This email not Registered!";
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "Email Address is required!";
    }
?>