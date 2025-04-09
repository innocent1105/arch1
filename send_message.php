<?php 
    
    require("header.php");

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $rawData = file_get_contents('php://input');

        // Decode the JSON data
        $data = json_decode($rawData, true);
        $user_id = stripslashes($data['userId']);
        $other_user_id = stripslashes($data['otherUserId']);
        $message = stripslashes($data['message']);
        $message_type = stripslashes($data['message_type']);

        $qry = "INSERT INTO `messages` (`sender`,`reciever`,  `message`, `message_type`) VALUES ('$user_id', '$other_user_id','$message', '$message_type')";
        $result = mysqli_query($con, $qry);
        if($result){
            echo "sent";
        }else{
            echo "failed";
        }
    }
?>






























