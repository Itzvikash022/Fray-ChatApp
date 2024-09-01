<?php
 while($row = mysqli_fetch_assoc($sql)){
    $sql2 = "SELECT * FROM tblmsg WHERE (incoming_msg_id = {$row['unique_id']}
    OR outgoing_msg_id = {$row['unique_id']}) AND  (incoming_msg_id = {$outgoing_id}
    OR outgoing_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1";

    $query2 = mysqli_query($conn, $sql2);
    $row1 = mysqli_fetch_assoc($query2);
    if(mysqli_num_rows($query2) > 0){
        $result = $row1['msg'];
        //checks if the msg sender is same as logged in user, and if true it puts You infront
        ($outgoing_id == $row1['outgoing_msg_id']) ? $you = "You: ": $you = "";
        //Triming msg till 28 letters
        (strlen($result) > 28) ? $msg = $you. substr($result,0,28).'...' : $msg = $you.$result;
    } else{
        $msg = "No message available";
    }
    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
  
    $output .= '<a href="chat.php?user_id='.$row['unique_id'].'">
                    <div class="content">
                        <img src="php/img/'. $row['img'] .'" alt="">
                        <div class="details">
                            <span>'. $row['fname'] ." ". $row['lname'] .'</span>
                            <p>'.$msg.'</p>
                        </div>
                    </div>
                    <div class="status-dot '.$offline.'">
                        <i class="fas fa-circle"></i>
                    </div>    
                </a>';
}
?>