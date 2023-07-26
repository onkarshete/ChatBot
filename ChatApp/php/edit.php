<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $about = mysqli_real_escape_string($conn, $_POST['about']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    if(!empty($fname) && !empty($lname) && !empty($about) && !empty($password)){
        if(($_FILES["image"]["error"] == 4)){
        	$encrypt_pass = md5($password);
            $update_query = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password = '{$encrypt_pass}', about = '{$about}' WHERE unique_id = {$_SESSION['unique_id']}");
            if($update_query){
                echo "Profile Updated Successfully";
            }else{
                echo "Something went wrong. Please try again!";
            }
        }else{
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
                        $encrypt_pass = md5($password);
                        $update_query = mysqli_query($conn, "UPDATE users SET fname = '{$fname}', lname = '{$lname}', password = '{$encrypt_pass}', img = '{$new_img_name}', about = '{$about}' WHERE unique_id = {$_SESSION['unique_id']}");
                        if($update_query){
                            echo "Profile Updated Successfully";
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
    }else{
        echo "All input fields are required!";
    }
?>