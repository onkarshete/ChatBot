<?php
    include_once "config.php";

    $sql = mysqli_query($conn, "SELECT unique_id FROM users WHERE user_type = 'user'") or die();
    if(mysqli_num_rows($sql) > 0){
        $a=array();
        while($row = mysqli_fetch_assoc($sql)){
            array_push($a,$row['unique_id']);
        }
    }
    $incoming_id = $a;
    $outgoing_id = $ran_id;

    $message = "Welcome To Our Service";
    if(!empty($message)){
        $msgtype = "text";
        for ($i=0; $i < count($incoming_id); $i++) { 
            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$incoming_id[$i]}, {$outgoing_id}, '{$message}', '{$msgtype}', now(), 0)") or die();
        }
    }

    $sql2 = mysqli_query($conn, "INSERT INTO {$db_name}(command_msg, command_reply) VALUES ('00','50. Grivience 97. Clear Chat<br>98. Talk with Customer Care<br>00. Main Menu<br>99. Exit<br>')") or die();
    $sql3 = mysqli_query($conn, "INSERT INTO {$db_name}(command_msg, command_reply) VALUES ('50','51. New Grivience<br>52. See Grivience Status')") or die();
    $sql4 = mysqli_query($conn, "INSERT INTO {$db_name}(command_msg, command_reply) VALUES ('51','Enter Details About Problem')") or die();
    $sql5 = mysqli_query($conn, "INSERT INTO {$db_name}(command_msg, command_reply) VALUES ('52','Your Previous Grievances are:')") or die();
    $griv_id = substr($ran_id, 0, 3);
    $sql6 = mysqli_query($conn, "INSERT INTO grievances VALUES ({$griv_id}, {$ran_id}, '100', 'Test Grievance', 'Solved')") or die();
    
    echo "success";

?>