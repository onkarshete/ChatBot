<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($_POST['g-recaptcha-response'])){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $secret = '6LfLTCobAAAAANaRlJ6RirP6SP1MwbXD80iZv-9Z';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if($responseData->success){
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                if(mysqli_num_rows($sql) > 0){
                    echo "$email - This email already Exist!";
                }else{
                    if(isset($_FILES['image'])){
                        $img_name = $_FILES['image']['name'];
                        $img_type = $_FILES['image']['type'];
                        $tmp_name = $_FILES['image']['tmp_name'];
                        
                        $img_explode = explode('.',$img_name);
                        $img_ext = end($img_explode);
        
                        $extensions = ["jpeg", "png", "jpg"];
                        if(in_array($img_ext, $extensions) === true){
                            $types = ["image/jpeg", "image/jpg", "image/png"];
                            if(in_array($img_type, $types) === true){
                                $time = time();
                                $new_img_name = $time.$img_name;
                                if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                    $ran_id = rand(time(), 100000000);
                                    $about = "Available";
                                    $db_name = $fname.'_commands';
                                    $encrypt_pass = md5($password);
                                    $encrypt_email = md5($email);
                                    $insert_query = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, about, email_verify, user_type)
                                    VALUES ({$ran_id}, '{$fname}', '{$lname}', '{$email}', '{$encrypt_pass}', '{$new_img_name}', '{$about}', '1', 'service')");
                                    if($insert_query){
                                        $create_query = mysqli_query($conn, "CREATE TABLE {$db_name} (id int(10) NOT NULL, command_msg text NOT NULL, command_reply text NOT NULL)");
                                        mysqli_query($conn, "ALTER TABLE {$db_name} ADD PRIMARY KEY (id)");
                                        mysqli_query($conn, "ALTER TABLE {$db_name} MODIFY id int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;");
                                        include_once "initiateservice.php";
                                    }else{
                                        echo "Something went wrong. Please try again!";
                                    }
                                }
                            }else{
                                echo "Please upload an image file - jpeg, png, jpg";
                            }
                        }else{
                            echo "Please upload an image file - jpeg, png, jpg";
                        }
                    }
                }
            }else{
                echo "Invalid Captcha!";
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }         
?>