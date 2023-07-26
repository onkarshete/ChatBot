<?php 
  session_start();
  $msg = "";
  include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  else{
    if(isset($_POST['add'])){
        $cn = $_POST['CommandNoAdd'];
        $cr = $_POST['CommandReplyAdd'];
        if($cn =="") {
            $msg = "Command No Cannot be Empty";
        }
        elseif($cr ==""){
            $msg = "Command Reply Cannot be Empty";
        }
        else{
            if(is_numeric($cn)){
                $sql = mysqli_query($conn, "SELECT * FROM {$_SESSION['servicedb']} WHERE command_msg = '{$cn}'");
                if(mysqli_num_rows($sql) > 0){
                    $msg = "Command No Already Exits";
                }
                else{
                    $query = "INSERT INTO {$_SESSION['servicedb']}(command_msg, command_reply) VALUES ('{$cn}','{$cr}')";
                    $res=$conn->prepare($query);
                    if($res->execute()){
                        $msg = "Command Added Successfully";
                    }else{
                        $msg = "Unable to Add Command";
                    }
                }
            }
            else{
                $msg = "Command No Must Be a Number!!";
            }
        }
        $_SESSION['Msg'] = $msg;
        header("Location: ../commands.php");
        exit();
    }

    if(isset($_POST['delete'])){
        $sr = $_POST['sr'];
        $query = "delete from {$_SESSION['servicedb']} where id = {$sr}";
        $res=$conn->prepare($query);
        if($res->execute()){
            $msg = "Command Deleted Successfully";
        }else {
            $msg = "Unable to Delete Command";
        }
        $_SESSION['Msg'] = $msg;
        header("Location: ../commands.php");
        exit();
    }
    
    if(isset($_POST['edit'])){
        $esno = $_POST['snoEdit'];
        $et = $_POST['CommandNoEdit'];
        $em = $_POST['CommandReplyEdit'];
        if($et =="") {
            $msg = "Command No Cannot be Empty";
        }
        elseif($em ==""){
            $msg = "Command Reply Cannot be Empty";
        }
        else{
            if(is_numeric($et)){
                if($_POST['updateTrue'] == $et){
                    $em = nl2br($em);
                    $query = "update {$_SESSION['servicedb']} set command_msg = '{$et}', command_reply = '{$em}' where id = {$esno}";
                    $res=$conn->prepare($query);
                    if($res->execute()){
                        $msg = "Command Updated Successfully";
                    }else {
                        $msg = "Unable to Update Command";
                    }
                }
                else{
                    $sql = mysqli_query($conn, "SELECT * FROM {$_SESSION['servicedb']} WHERE command_msg = '{$et}'");
                    if(mysqli_num_rows($sql) > 0){
                        $msg = "Command No Already Exist";
                    }
                    else{
                        $query = "update {$_SESSION['servicedb']} set command_msg = '{$et}', command_reply = '{$em}' where id = {$esno}";
                        $res=$conn->prepare($query);
                        if($res->execute()){
                            $msg = "Command Updated Successfully";
                        }else {
                            $msg = "Unable to Update Command";
                        }
                    }
                }
            }
            else{
                $msg = "Command No Must Be a Number!!";
            }
        }
        $_SESSION['Msg'] = $msg;
        header("Location: ../commands.php");
        exit();
    }
}
?>
