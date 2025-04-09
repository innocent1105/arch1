<?php 
	require("header.php");
	$user_data = check_login($con);
    $user_id = $user_data['user_id'];

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
<body>
    <!-- <?php include "./loading.php" ?> -->
    <?php include "./components/top-nav.php" ?>
    
    <div class="chat-system w-full p-2 mt-16 flex gap-1">
    <div class=" messages-mobile w-full p-2">
            <div class="header text-xl px-4 mb-4">
                Messages
            </div>
            <div class="users w-full ">
                <!-- <?php
                    $sql = "select * from messages where sender = '$user_id' or reciever = '$user_id' ";
                    $result = mysqli_query($con, $sql);

                    if($result -> num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            
                    ?>

                    <?php
                        }
                    }

                ?> -->




                <!-- users -->
                <?php
                    $qry = "select * from users order by date_created desc limit 10";
                    $result = mysqli_query($con, $qry);

                    if($result -> num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $other_user_name = $row['username'];
                            $other_user_id = $row['user_id'];
                ?>
                <a href="./chat.php?id=<?php echo $other_user_id ?>">
                    <div onclick="currentUser(<?php echo $other_user_id ?>)" class="user w-full my-2 p-2 rounded-md border border-gray-900 flex gap-2 hover:bg-gray-900 active:scale-95 cursor-pointer transition-all ">
                        <img class=" w-10 h-10 rounded-full border border-blue-700 object-fit-cover" src="./profile_pictures/pp.jpg" alt="">
                        <div class="user-det">
                            <div class="username text-md"><?php echo $other_user_name; ?></div>
                            <div class="message text-sm text-gray-500">Hello have you uploaded th...</div>
                        </div>
                    </div>
                </a>
                <?php
                        }
                    }
                ?> 

                <div class="user w-full my-2 p-2 rounded-md flex gap-2 hover:bg-gray-900 active:scale-95 cursor-pointer transition-all ">
                    <img class=" w-10 h-10 rounded-full border border-blue-700 object-fit-cover" src="./profile_pictures/pp.jpg" alt="">
                    <div class="user-det">
                        <div class="username text-md">Admin account</div>
                        <div class="message text-sm text-gray-500">Hello have you uploaded th...</div>
                    </div>
                </div>

            </div>

        </div>

        
    </div>




    <div class="mobile-bottom-bar">
        <?php include "./bottom_nav.php" ?>
    </div>

    <script>
        // window.onload = function(){
        //     stopLoading();
        // }

        let sendBtn = document.getElementById("send-btn");
        let messageBox = document.getElementById("message-box");
        let textMessageBox = document.getElementById("text-sent");
        sendBtn.addEventListener("click", ()=>{
            textMessage = textMessageBox.value;
            console.log(textMessage);
            let message = document.createElement("div");
                message.innerHTML = `
                <div class="message m-2 flex justify-between gap-2">
                    <div class="a w-2/3">
                    </div>
                    <div class="sender w-auto rounded-lg p-2 mr-10 bg-green-900 text-sm text-gray-200">
                        ${textMessage}
                    </div>
                </div>
            `;
            textMessageBox.value = "";
            messageBox.appendChild(message);
        })

        let otherUser = "";
        function currentUser(otherUserId){
            otherUser = otherUserId;
            startLoading();
            console.log(otherUser);
        }
    </script>
</body>
</html>

































