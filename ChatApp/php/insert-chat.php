<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        
        if($_FILES["image-att"]["error"] != 4){
            $img_name = $_FILES['image-att']['name'];
            $img_type = $_FILES['image-att']['type'];
            $tmp_name = $_FILES['image-att']['tmp_name'];
            
            $img_explode = explode('.',$img_name);
            $img_ext = end($img_explode);

            $extensions = ["jpeg", "png", "jpg"];
            if(in_array($img_ext, $extensions) === true){
                $types = ["image/jpeg", "image/jpg", "image/png"];
                if(in_array($img_type, $types) === true){
                    $time = time();
                    $new_img_name = $time.$img_name;
                    if(move_uploaded_file($tmp_name,"chatimages/".$new_img_name)){
                        $msgtype = "image";
                        $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$incoming_id}, {$outgoing_id}, '{$new_img_name}', '{$msgtype}', now(), 0)") or die();
                    }
                }else{
                    echo "Please upload an image file - jpeg, png, jpg";
                }
            }else{
                echo "Please upload an image file - jpeg, png, jpg";
            }
        }else{
            $message = mysqli_real_escape_string($conn, $_POST['message']);
            if(!empty($message)){
                $msgtype = "text";
                if($_SESSION['autochat'] == 0 || $_SESSION['griv'] == 1){
                    $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$msgtype}', now(), 1)") or die();
                }else{
                    $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$incoming_id}, {$outgoing_id}, '{$message}', '{$msgtype}', now(), 0)") or die();
                }
                include_once "autochat.php";
            }
        }
    }else{
        header("location: ../login.php");
    }
    
?>