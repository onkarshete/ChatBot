<?php 
  session_start();
  $msg = "";
  include_once "config.php";
  if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
  }
  else{

    if(isset($_POST['delete'])){
        $sr = $_POST['sr'];
        $query = "delete from grievances where id = {$sr}";
        $res=$conn->prepare($query);
        if($res->execute()){
            $msg = "Grievance Deleted Successfully";
        }else {
            $msg = "Unable to Delete Grievance";
        }
        $_SESSION['Msg'] = $msg;
        header("Location: ../grievance.php");
        exit();
    }
    
    if(isset($_POST['edit'])){
        $gno = $_POST['grivEdit'];
        $gs = $_POST['grivSEdit'];
        if($gs =="") {
            $msg = "Grievance Status Cannot be Empty";
        }
        else{
            $query = "update grievances set status = '{$gs}' where id = {$gno}";
            $res=$conn->prepare($query);
            if($res->execute()){
                $msg = "Grievance Status Updated Successfully";
            }else {
                $msg = "Unable to Update Grievance Status";
            }
        }
        $_SESSION['Msg'] = $msg;
        header("Location: ../grievance.php");
        exit();
    }
}
?>
