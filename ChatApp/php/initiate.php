<?php
    include_once "config.php";

    $sql = mysqli_query($conn, "SELECT unique_id FROM users WHERE user_type = 'service'") or die();
    if(mysqli_num_rows($sql) > 0){
        $a=array();
        while($row = mysqli_fetch_assoc($sql)){
            array_push($a,$row['unique_id']);
        }
    }
    $incoming_id = $ran_id;
    $outgoing_id = $a;

    $message = "Welcome To Our Service";
    if(!empty($message)){
        $msgtype = "text";
        for ($i=0; $i < count($outgoing_id); $i++) { 
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$incoming_id}, {$outgoing_id[$i]}, '{$message}', '{$msgtype}', now(), 0)") or die();
        }
    }
    
?>