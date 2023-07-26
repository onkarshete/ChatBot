<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['unique_id'];
    $sql = "SELECT incoming_msg_id as user_msg_id FROM messages WHERE outgoing_msg_id = {$outgoing_id} UNION SELECT outgoing_msg_id as user_msg_id FROM messages WHERE incoming_msg_id = {$outgoing_id}";
    $query = mysqli_query($conn, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $sql2 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['user_msg_id']}
                    OR outgoing_msg_id = {$row['user_msg_id']}) AND (outgoing_msg_id = {$outgoing_id} 
                    OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";
            $query2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($query2);
            (mysqli_num_rows($query2) > 0) ? $result = $row2['msg'] : $result ="No Message Available";
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row2['outgoing_msg_id'])){
                ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = "";
            }else{
                $you = "";
            }
            $sql3 = "SELECT * FROM users WHERE unique_id = {$row['user_msg_id']}";
            $query3 = mysqli_query($conn, $sql3);
            $row3 = mysqli_fetch_assoc($query3);
            $sql4 = "SELECT * FROM messages WHERE incoming_msg_id = {$outgoing_id} AND outgoing_msg_id = {$row['user_msg_id']} AND msg_status = 0";
            $query4 = mysqli_query($conn, $sql4);
            (mysqli_num_rows($query4) > 0) ? $unread = mysqli_num_rows($query4) : $unread ="";
            $now = new DateTime();
            $lastlog = new DateTime($row3['last_log']);
            if ($lastlog->modify('+10 seconds') < $now) {
                $offline = "offline";
            }else{
                $offline = "";
            }
            //($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
            ($outgoing_id == $row3['unique_id']) ? $hid_me = "hide" : $hid_me = "";

            $output .= '<a href="chat.php?user_id='. $row3['unique_id'] .'">
                        <div class="content">
                        <img src="php/images/'. $row3['img'] .'" onerror="this.src=\'php/images/Default.png\'" alt="">
                        <div class="details">
                            <span>'. $row3['fname']. " " . $row3['lname'] .'</span>
                            <p>Click To See Messages</p>
                        </div>
                        </div>

                        <div class="status-dot '. $offline .'"><div class="unread-messsages">'. $unread .'</div><i class="fas fa-circle"></i>
                        </div>
                    </a>';
        }
    }
    //<p>'. $you . $msg .'</p>
    echo $output;
?>