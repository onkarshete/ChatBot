<?php 
    session_start();
    include_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) > 0){
                $row = mysqli_fetch_assoc($sql);
                if($row['email_verify'] == 1){
                    $user_pass = md5($password);
                    $enc_pass = $row['password'];
                    if($user_pass === $enc_pass){
                        $sql2 = mysqli_query($conn, "UPDATE users SET last_log = now() WHERE unique_id = {$row['unique_id']}");
                        if($sql2){
                            $_SESSION['unique_id'] = $row['unique_id'];
                            $_SESSION['pass'] = $password;
                            $_SESSION['admin'] = 0;
                            if($row['user_type'] == "admin"){
                                $_SESSION['admin'] = 1;
                            }
                            echo "success";
                        }else{
                            echo "Something went wrong. Please try again!";
                        }
                    }else{
                        echo "Email or Password is Incorrect!";
                    }
                }else{
                    echo "Email is Not Verified! Check Your Mail or <a class='link' href='http://localhost/ChatApp/php/resendmail.php?email={$email}'>Click Here</a> to Resend";
                }
            }else{
                echo "$email - This email not Registered!";
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>