<?php
	require("header.php");
    if($_SERVER['REQUEST_METHOD'] == "GET"){
        $user_id = $_GET['user'];
        $other_user_id = $_GET['other_user'];
    }

?>

    <?php 
        $query = "select * from messages where sender = '$user_id' and reciever = '$other_user_id' or sender = '$other_user_id' and reciever = '$user_id'";
        $result = mysqli_query($con, $query);
        $message = "";
        $last_message = "";
        if($result->num_rows > 0){
            while($row = mysqli_fetch_assoc($result)){
                $message = $row['message'];
                $is_read = $row['seen'];
           
                if($row['sender'] == $user_id){
                ?>   
                <span id="<?php echo $message_id ?>" class="message m-2 flex justify-between gap-2">
                    <div class="a w-2/3">
                    </div>
                    <div class="sender w-auto rounded-lg p-2 bg-green-900 text-sm text-gray-200">
                        <?php echo $message ?>
                    </div>
                </span>

                <?php  
                }else{
                    if($is_read == "sent"){
                        // update as read
                        $sql = "update messages  set seen = 'delivered' where id = '$message_id'";
                        $result3 = mysqli_query($con, $sql);
                        if($result3){
                            echo "you saw this message";
                        }else{
                            echo "failed to update message status";
                        }
                ?>
                   



                <?php
                    }
                ?>
                    <span name="<?php echo $message_id ?>" class="message bg-green-50 m-2 flex gap-2">
                        <div class="recieving w-auto max-w-1/3 text-gray-400 rounded-lg p-2 text-sm">
                            <?php echo $message ?>
                        </div>
                        <div class="a w-2/3">
                        </div>
                    </span>
           
                <?php

                 
                }
            }

           

          


        }
    ?>

<script>

</script>






