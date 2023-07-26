<?php 
    session_start();
    if(isset($_SESSION['unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['unique_id'];
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
        $output = "";
        $settime = "";
        $timevar = "";
        $sql = "SELECT * FROM messages LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
        $query = mysqli_query($conn, $sql);
        $msgstatus = "UPDATE messages SET msg_status = 1 WHERE (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})";
        $statusquery = mysqli_query($conn, $msgstatus);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                $now = new DateTime();
                $msgtime = new DateTime($row['msg_time']);
                if ($msgtime->format('d m') == $now->format('d m') && $timevar != "Today"){
                    $timevar = "Today";
                    $settime = $msgtime->format('d M');
                    $output .= '<p class="is-time">'.$timevar.'</p>';
                }elseif($msgtime->format('d M') != $settime){
                    $timevar = $msgtime->format('d M');
                    $settime = $timevar;
                    $output .= '<p class="is-time">'.$timevar.'</p>';
                }
                if($row['outgoing_msg_id'] === $outgoing_id){
                    if ($row['msg_status'] == 1) {
                        $class = "status is-seen";
                    }else{
                        $class = "status";
                    }
                    if($row['msg_type'] == "image"){
                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p><img src="php/chatimages/'. $row['msg'] .'" style="border-radius: 18px 18px 18px 18px; height:200px; width:200px;" onerror="this.src=\'php/chatimages/Default.png\'" alt=""></p><time datetime>'.$msgtime->format('h:i A').'<span class="'.$class.'"><svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="18" height="18"><path fill="#4FC3F7" d="M17.394 5.035l-.57-.444a.434.434 0 0 0-.609.076l-6.39 8.198a.38.38 0 0 1-.577.039l-.427-.388a.381.381 0 0 0-.578.038l-.451.576a.497.497 0 0 0 .043.645l1.575 1.51a.38.38 0 0 0 .577-.039l7.483-9.602a.436.436 0 0 0-.076-.609zm-4.892 0l-.57-.444a.434.434 0 0 0-.609.076l-6.39 8.198a.38.38 0 0 1-.577.039l-2.614-2.556a.435.435 0 0 0-.614.007l-.505.516a.435.435 0 0 0 .007.614l3.887 3.8a.38.38 0 0 0 .577-.039l7.483-9.602a.435.435 0 0 0-.075-.609z"></path></svg></span></time>
                                </div>
                                </div>';
                    }else{
                        $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p><time datetime>'.$msgtime->format('h:i A').'<span class="'.$class.'"><svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="18" height="18"><path fill="#4FC3F7" d="M17.394 5.035l-.57-.444a.434.434 0 0 0-.609.076l-6.39 8.198a.38.38 0 0 1-.577.039l-.427-.388a.381.381 0 0 0-.578.038l-.451.576a.497.497 0 0 0 .043.645l1.575 1.51a.38.38 0 0 0 .577-.039l7.483-9.602a.436.436 0 0 0-.076-.609zm-4.892 0l-.57-.444a.434.434 0 0 0-.609.076l-6.39 8.198a.38.38 0 0 1-.577.039l-2.614-2.556a.435.435 0 0 0-.614.007l-.505.516a.435.435 0 0 0 .007.614l3.887 3.8a.38.38 0 0 0 .577-.039l7.483-9.602a.435.435 0 0 0-.075-.609z"></path></svg></span></time>
                                </div>
                                </div>';
                    }
                }else{
                    if($row['msg_type'] == "image"){
                        $output .= '<div class="chat incoming">
                                <img src="php/images/'.$row['img'].'" style="margin-bottom: 20px;" onerror="this.src=\'php/images/Default.png\'" alt="">
                                <div class="details">
                                    <p><img src="php/chatimages/'. $row['msg'] .'" style="border-radius: 18px 18px 18px 18px; height:200px; width:200px;" onerror="this.src=\'php/chatimages/Default.png\'" alt=""></p><time style="float: left;" datetime>'.$msgtime->format('h:i A').'</time>
                                </div>
                                </div>';
                    }else{
                        $output .= '<div class="chat incoming">
                                    <img src="php/images/'.$row['img'].'" style="margin-bottom: 20px;" onerror="this.src=\'php/images/Default.png\'" alt="">
                                    <div class="details">
                                        <p>'. $row['msg'] .'</p><time style="float: left;" datetime>'.$msgtime->format('h:i A').'</time>
                                    </div>
                                    </div>';
                    }
                }
            }
        }else{
            $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>