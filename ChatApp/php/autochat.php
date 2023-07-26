<?php
    $sql1 = "SELECT * FROM users WHERE unique_id = {$outgoing_id}";
    $query1 = mysqli_query($conn, $sql1);
    if(mysqli_num_rows($query1) > 0){
        while($row1 = mysqli_fetch_assoc($query1)){
            if($row1['user_type'] === "user"){
                $sql = mysqli_query($conn, "SELECT * FROM users WHERE user_type = 'service'");
                if(mysqli_num_rows($sql) > 0){
                    $servicelist = array();
                    while($row = mysqli_fetch_assoc($sql)){
                        array_push($servicelist, $row['unique_id']);
                    }
                }
                if(in_array($incoming_id, $servicelist)){
                    $sql2 = mysqli_query($conn, "SELECT * FROM users WHERE unique_id = {$incoming_id}");
                    if(mysqli_num_rows($sql2) > 0){  
                        $row2 = mysqli_fetch_assoc($sql2);
                        $database = $row2['fname'].'_commands';
                    }
                }
                if($_SESSION['griv'] == 1){
                    $_SESSION['griv'] = 0;
                    $_SESSION['autochat'] = 1;
                    $sqlgriv = "SELECT * FROM messages WHERE incoming_msg_id = {$incoming_id} AND outgoing_msg_id = {$outgoing_id} ORDER BY msg_id DESC LIMIT 1";
                    $qgriv = mysqli_query($conn, $sqlgriv);
                    $rowgriv = mysqli_fetch_assoc($qgriv);
                    $griv_id = rand(1000,9999);
                    if(mysqli_num_rows($qgriv) > 0){
                        $msggriv = $rowgriv['msg'];
                        mysqli_query($conn, "INSERT INTO grievances (id, service_id, user_id, griv_msg, status) VALUES ({$griv_id}, {$incoming_id}, {$outgoing_id}, '{$msggriv}', 'UnSolved')") or die();
                        $msggriv1 = "Your Grievance ID is " . $griv_id ."<br>";
                        $msggriv1 = $msggriv1 . "00. Main Menu<br>99. Exit";
                        mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$outgoing_id}, {$incoming_id}, '{$msggriv1}', '{$msgtype}', now(), 1)") or die();
                    }
                }
                if($_SESSION['autochat'] == 0){
                    $_SESSION['autochat'] = 0;
                    if(is_numeric($message)){
                        $sql2 = "SELECT * FROM {$database} WHERE command_msg = {$message}";
                        $query2 = mysqli_query($conn, $sql2);
                        if(mysqli_num_rows($query2) > 0){
                            while($row2 = mysqli_fetch_assoc($query2)){
                                $msg = $row2['command_reply'];
                            }
                            mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$outgoing_id}, {$incoming_id}, '{$msg}', '{$msgtype}', now(), 0)") or die();
                        }
                        else{
                            $msg = "Please Choose Correct Option...";
                            mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$outgoing_id}, {$incoming_id}, '{$msg}', '{$msgtype}', now(), 0)") or die();
                        }
                        if($message == "97"){
                            $_SESSION['autochat'] = 0;
                            mysqli_query($conn, "DELETE FROM messages WHERE incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$incoming_id}") or die();
                            mysqli_query($conn, "DELETE FROM messages WHERE incoming_msg_id = {$incoming_id} AND outgoing_msg_id = {$outgoing_id}") or die();
                            $msgtext = "Welcome To Our Service";
                            $sql = mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$outgoing_id}, {$incoming_id}, '{$msgtext}', 'text', now(), 0)") or die();
                            echo "exit";
                        }
                        if($message == "51"){
                            $_SESSION['autochat'] = 1;
                            $_SESSION['griv'] = 1;
                        }
                        if($message == "52"){
                            $_SESSION['autochat'] = 0;
                            $sqlgriv = "SELECT * FROM grievances WHERE user_id = {$outgoing_id} AND service_id = {$incoming_id}";
                            $qgriv = mysqli_query($conn, $sqlgriv);
                            $msggriv = "";
                            if(mysqli_num_rows($qgriv) > 0){
                                while($rowgriv = mysqli_fetch_assoc($qgriv)){
                                    $msggriv = $msggriv . $rowgriv['id'] . " - " . $rowgriv['status'] . "<br>";
                                }
                                $msggriv = $msggriv . "00. Main Menu<br>99. Exit";
                                mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$outgoing_id}, {$incoming_id}, '{$msggriv}', '{$msgtype}', now(), 1)") or die();
                            }else{
                                mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$outgoing_id}, {$incoming_id}, 'No Grivience Found', '{$msgtype}', now(), 1)") or die();
                            }
                        }
                        if($message == "98"){
                            $_SESSION['autochat'] = 1;
                            $_SESSION['griv'] = 999;
                        }
                        if($message == "99"){
                            $_SESSION['autochat'] = 1;
                            echo "exit";
                        }
                        if($message == "00"){
                            $_SESSION['autochat'] = 0;
                        }
                    }
                    else{
                        $msg = "I Cant Understand...";
                        mysqli_query($conn, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, msg_type, msg_time, msg_status) VALUES ({$outgoing_id}, {$incoming_id}, '{$msg}', '{$msgtype}', now(), 0)") or die();
                    }
                }

                if($_SESSION['griv'] == 0){
                    $_SESSION['autochat'] = 0;
                }
            }
        }
    }
?>