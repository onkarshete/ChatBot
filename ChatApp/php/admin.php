<?php
    session_start();
    include_once "config.php";
    $type = $_SESSION['type'];
    $sql = "SELECT * FROM users WHERE user_type = '{$type}'";
    $query = mysqli_query($conn, $sql);
    $output = "<br>";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available";
    }elseif(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['user_type'] == "service") { 
                $output .= '<a href="#">
                        <div class="content">
                        <img src="php/images/'. $row['img'] .'" onerror="this.src=\'php/images/Default.png\'" alt="">
                        <div class="details">
                            <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        </div>
                        </div>

                        <div class="status-dot">
                        </div>
                        </a>';

            }elseif($row['user_type'] == "user") { 
                $output .= '<a href="php/delete.php?did='. $row['unique_id'] .'&type='. $row['user_type'] .'">
                        <div class="content">
                        <img src="php/images/'. $row['img'] .'" onerror="this.src=\'php/images/Default.png\'" alt="">
                        <div class="details">
                            <span>'. $row['fname']. " " . $row['lname'] .'</span>
                        </div>
                        </div>

                        <div class="status-dot">
                            <button class="btn">Delete</button>
                        </div>
                        </a>';
            }
        }
    }
    echo $output;
?>