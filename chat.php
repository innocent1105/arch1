<?php 
	require("header.php");
	$user_data = check_login($con);
    $user_id = $user_data['user_id'];

    if(isset($_GET['id'])){
        $other_user_id = $_GET['id'];
        $qry = "select * from users where user_id = '$other_user_id'";
        $result = mysqli_query($con, $qry);
        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
                $other_user_name = $row['username'];
                $other_user_pp = $row['pp'];
            }
        }
    }
    // echo $user_id;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realism Studio</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/icons.css">
    <style>
       
    </style>
</head>
<body class="chat-body">
    <input type="text" id="user-id" class="hidden" value="<?php echo $user_id ?>">
    <input type="text" id="other-user-id" class="hidden" value="<?php echo $other_user_id ?>">

    <!-- <?php include "./loading.php" ?> -->
    <?php include "./components/top-nav.php" ?>
    
    <div class="mobile-bottom-bar bottom-0">
        <?php include "./bottom_nav.php" ?>
    </div>
    
    <div class="chat-system w-full p-2 mt-16 flex gap-1">

        <div class="w-full h-auto">
            <div id="reload" class="user w-full p-2 pb rounded-md flex gap-2 hover:bg-gray-900 active:scale-95 cursor-pointer transition-all ">
                <img class=" w-10 h-10 rounded-full border border-blue-700 object-fit-cover" src="./profile_pictures/<?php echo $other_user_pp; ?>" alt="">
                <div class="user-det">
                    <div class="username text-md"><?php echo $other_user_name . " and " . $user_data['username'] ?></div>
                    <div class="online-status text-sm"> <span class=" text-green-500 text-xs">Online</span></div>
                </div>
            </div>

            <!-- <div class="messages-area w-full border p-2 overflow-y-scroll"> -->
            <div id="message-box" class="messages-area w-full p-2 overflow-y-scroll">
                <!-- <?php 
                    $last_message = "";
                    $query = "select * from messages where sender = '$user_id' and reciever = '$other_user_id' or sender = '$other_user_id' and reciever = '$user_id'";
                    $result = mysqli_query($con, $query);
                   
                    if($result->num_rows > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $message = $row['message'];
                            if($row['sender'] == $user_id){
                            ?>   
                            <div class="message m-2 flex justify-between gap-2">
                                <div class="a w-2/3">
                                </div>
                                <div class="sender w-auto rounded-lg p-2 bg-green-900 text-sm text-gray-200">
                                    <?php echo $message ?>
                                </div>
                            </div>

                            <?php  
                            }else{
                            ?>
                                <div class="message m-2 flex gap-2">
                                    <div class="recieving w-auto max-w-1/3 text-gray-400 rounded-lg p-2 text-sm">
                                        <?php echo $message ?>
                                    </div>
                                    <div class="a w-2/3">
                                    </div>
                                </div>
                            <?php
                            }
                        }
                    }
                ?> -->

              <!-- <div class="message m-2 flex justify-between gap-2">
                    <div class="a w-2/3">
                    </div>
                    <div class="sender w-auto rounded-lg p-2 bg-green-900 text-sm text-gray-200">
                        heyw3,4bh34 3o4uoj34q ir4q3jhrih 23qirh3ku thk3i4 t2oq3ru b4riuw34broi34jr 2oqi3r23oi rh
                    </div>
                </div> -->
                
                <!-- <div class="message m-2 flex gap-2">
                    <div class="recieving w-auto max-w-1/3 text-gray-400 rounded-lg p-2 text-sm">
                        hey wkjug 23qkjnr 23qopirji23 hqrygy2gr iu23qh iorjy234ry2 grih 23iug ei2u3gqriu2g3ryg23iur iu23g qru32yryj2g3ryg23iu riu23 rquf 23iur oiq32rh 2y3 ruy2qg3riu23oh riu2 g3qury
                    </div>
                    <div class="a w-2/3">
                    </div>
                </div>  -->
                
                <div id="unread-note" class="last-part hidden p-2 w-full text-sm text-gray-500 text-center border">Unread message</div>

            </div>
            <div id="scroll-btn-area" class="scroll-btn p-2 hidden justify-end absolute">
                <div id="scroll-btn" class="scroll-btn align-center flex justify-center rounded-full w-8 h-8 bg-green-900 shadow-lg border border-green-800">
                    <i class="si-arrow-down"></i>
                </div>
            </div>
            <!-- <div class="bttom-spc bg-black absolute h-10 w-full"></div> -->
            <div class="input-area bottom-10 flex gap-2">
                <textarea name="" id="text-sent" class=" w-full rounded-lg p-2 bg-gray-900 resize-none" placeholder="Start typing"></textarea>
                
                <div id="send-btn" class="send-btn h-12 text-2xl cursor-pointer p-2 px-3 rounded-md hover:bg-gray-900 transition-all">
                    <i class="si-arrow-circle-up"></i>
                </div>
            </div>



        </div>
    </div>
   
    <audio id="sound" src="./sound/messenger_pc_web.mp3"></audio>

    <script src="./js/jquery.js"></script>
    <script>
        let userId = document.getElementById("user-id").value;
        let otherUserId = document.getElementById("other-user-id").value;

        let sendBtn = document.getElementById("send-btn");
        let messageBox = document.getElementById("message-box");
        let textMessageBox = document.getElementById("text-sent");
        let unreadNote = document.getElementById("unread-note");
        let scrollBtnArea = document.getElementById("scroll-btn-area");
        let scrollBtn = document.getElementById("scroll-btn");

        let notificationSound = document.getElementById("sound");
        scrollBtn.addEventListener("click", ()=>{
            let div = document.createElement("div");
            messageBox.appendChild(div);
            div.scrollIntoView({behavior:"smooth"});
            scrollBtnArea.style.display = "none";
        })




        // recieve messages

        $(document).ready(function(){
            let div = document.createElement("div");
            messageBox.appendChild(div);
            div.scrollIntoView({behavior:"smooth"});
        })

        setInterval(function(){
            $("#message-box").load(`load_messages.php?user=${userId}&other_user=${otherUserId}`);
            var lastMessage = $("span").last().attr('name');
            // console.log(lastMessage);
        },1500);









        // window.onload = function(){
        //     stopLoading();
        // }
 

        sendBtn.addEventListener("click", ()=>{
            textMessage = textMessageBox.value;
            // console.log(textMessage);
            // console.log("user_id", userId);
            let message = document.createElement("div");
                message.innerHTML = `
                <div class="message m-2 flex justify-between gap-2">
                    <div class="a w-2/3">
                    </div>
                    <div class="sender w-auto rounded-lg p-2 bg-green-900 text-sm text-gray-200">
                        ${textMessage}
                    </div>
                </div>
            `;
            let data = {
                "userId": userId,
                "otherUserId": otherUserId,
                "message": textMessage,
                "message_type": "text"
            }
            data = JSON.stringify(data);
            $.ajax({
                type: "POST",
                url: "send_message.php",
                data: data,
                beforeSend: ()=>{
                    // console.log("sending");
                },
                success: (response)=>{
                    console.log(response);
                },
                error: ()=>{
                    console.log("failed to send");
                }
            })


            textMessageBox.value = "";
            messageBox.appendChild(message);
            message.scrollIntoView({
                behavior:"smooth"
            });
        })

        let otherUser = "";
        function currentUser(otherUserId){
            otherUser = otherUserId;
            // console.log(otherUser);
        }
    </script>
</body>
</html>

































