<?php 
	require("header.php");
	$user_data = check_login($con);
    $user_id = $user_data['user_id'];
    $user_name = $user_data['username'];
    $user_pp = $user_data['pp'];

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
    
    <div class="profile">
        <div class="profile-picture-area px-3 pt-24 pb-2 w-full border">
            <img class=" w-12 h-12 rounded-full border border-blue-700 object-fit-cover" src="./profile_pictures/<?php echo $user_pp; ?>" alt="">
            <!-- <div class="upload-image border p-1 w-10 h-10 flex justify-center rounded-full">
                <i class="si-camera"></i>
            </div> -->
            <div class="user-name mt-2 font-medium text-md">
                <?php echo $user_name;?>
                <div class="user-type font-light text-sm text-gray-400">
                    <?php echo $user_data['account_type'] ?>
                </div>
            </div>
        </div>
        <div class="profile-btns flex justify-between gap-1 m-2">
            <a class=" border p-2 px-10 rounded-md border-gray-800" href="./edit_profile.php">Edit profile</a>
            <a class=" p-2 px-10 rounded-md bg-blue-700 font-medium" href="./upload.php">Post model</a>
        </div>

        <div class="about-user m-2 p-2">
            <div class="det w-full mt-1 flex gap-2">
                <i class="si-message"></i>
                <div class=" text-sm text-gray-500">
                    <?php 
                        if(empty($user_data['email'])){
                            echo "  Add email address";
                        }else{
                            echo $user_data['email'];
                        }
                    ?>
                </div>
            </div>

            <div class="det w-full mt-1 flex gap-2">
                <i class="si-address-book"></i>
                <div class=" text-sm text-gray-500">
                    <?php 
                        if(empty($user_data['phone_number'])){
                            echo " Add phone number";
                        }else{
                            echo $user_data['phone_number'];
                        }
                    ?>
                </div>
            </div>
            
            <div class="det w-full mt-1 flex gap-2">
                <i class="si-map"></i>
                <div class=" text-sm text-gray-500">
                    <?php 
                        if(empty($user_data['country'])){
                            echo " - ";
                        }else{
                            echo $user_data['country'];
                        }
                    ?>
                </div>
            </div>

            <div class="det w-full mt-1 flex gap-2">
                <i class="si-location"></i>
                <div class=" text-sm text-gray-500">
                    <?php 
                        if(empty($user_data['city'])){
                            echo " - ";
                        }else{
                            echo $user_data['city'];
                        }
                    ?>
                </div>
            </div>

        </div>
        
        <div class="logout-btn text-red-500 text-medium m-4 mt-8 cursor-pointer hover:bg-gray-900">
            <a href="./logout.php">Log out</a>
        </div>

    </div>
    
    <div class="mobile-bottom-bar bottom-0">
        <?php include "./bottom_nav.php" ?>
    </div>

    <script src="./js/jquery.js"></script>
    <script>
     
        // window.onload = function(){
        //     stopLoading();
        // }
 
    </script>
</body>
</html>

































