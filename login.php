<?php
    session_start();
        
    include("./connection.php");
    include("./functions.php");
    
    

    $error_response = "";

     // $error_response = "";
     if(isset($_GET['error'])){
        $error_response = $_GET['error'];
        if($error_response == "'1'"){
            $error_response = '
            <div class="error-msg w-full p-2 border border-red-500 text-red-500 text-xs rounded">
                Please fill in all the fields.
            </div>
        ';
        }else if($error_response == "'2'"){
            $error_response = '
            <div class="error-msg w-full p-2 border border-red-500 text-red-500 text-xs rounded">
                Unregistered user.
            </div>
        ';
        }else if($error_response == "'3'"){
            $error_response = '
            <div class="error-msg w-full p-2 border border-red-500 text-red-500 text-xs rounded">
                Incorrect password.
            </div>
        ';
        }else{
            $error_response = '
                <div class="error-msg w-full p-2 border border-red-500 text-red-500 text-xs rounded">
                    Unknown error occurred
                </div>
            ';
        }
    }else{
        $error_response = "";
    }

    if(isset($_GET['shared'])){
        $model_id = $_GET['shared'];
        // echo $model_id;
        $qry = "select * from projects where model_name = '$model_id' limit 1";
        $result = mysqli_query($con, $qry);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $user_id = $row['user_id'];
                $project_name = $row['project_name'];
                $project_description = $row['project_description'];
                $model_images = $row['model_images'];
                $privacy = $row['privacy'];
                $views = $row['views'];
                $interested = $row['interested'];
                $date_created = $row['date_created'];
                $model_name = $row['model_name'];
                $model_images = json_decode($model_images, true);
                // var_dump($model_images);
                
                // user data 
                $query = "select * from users where user_id = '$user_id' limit 1";
                $result = mysqli_query($con, $query);
                if($result->num_rows > 0){
                    while($user = $result->fetch_assoc()){
                        $username = $user['username'];
                        $profile_picture = $user['pp'];
                        $account_type = $user['account_type'];
                    }
                }
            }
        }
    }else{
    

        $model_name = "";
        $qry = "select * from projects limit 1";
        $result = mysqli_query($con, $qry);
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $id = $row['id'];
                $user_id = $row['user_id'];
                $project_name = $row['project_name'];
                $project_description = $row['project_description'];
                $model_images = $row['model_images'];
                $privacy = $row['privacy'];
                $views = $row['views'];
                $interested = $row['interested'];
                $date_created = $row['date_created'];
                $model_name = $row['model_name'];
                $model_images = json_decode($model_images, true);
                // var_dump($model_images);
                
                // user data 
                $query = "select * from users where user_id = '$user_id' limit 1";
                $result = mysqli_query($con, $query);
                if($result->num_rows > 0){
                    while($user = $result->fetch_assoc()){
                        $username = $user['username'];
                        $profile_picture = $user['pp'];
                        $account_type = $user['account_type'];
                    }
                }
            }
        }
    }


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
<body><input type="text" id="model-name" class=" hidden" value="<?php echo $model_name ?>">
<?php include "./loading.php" ?>
    <div class="container" id="container">
        
        <div class="mobile-top-bar">
            <!-- <div class="search-section">
                 <div class="search-bar">
                    <input type="text">
                </div> 
                <div class="search-icon">
                    <i class="si-search"></i>
                </div>
            </div> -->
            <div class="mobile-model-views">
                <?php
                    for ($i=0; $i < count($model_images); $i++) {
                        if($i == 0){
                        ?>
                            <div class="mobile-main-view">
                                <img src="./models/images/<?php echo $model_images[$i]; ?>" class="border border-gray-700" alt="">
                            </div>
                            <div class="mobile-other-views">
                        <?php
                        }else{
                            ?>
                                <img src="./models/images/<?php echo $model_images[$i]; ?>" class="border border-gray-800" alt="">
                            <?php
                        }
                    }
                ?>
                </div>

            </div>

        </div>

        <div class="mobile-bottom-bar">
            <div class="user-details w-full  p-2">
                <div class="mobile-user ">
                    <div class="user-left">
                        <img src="./profile_pictures/<?php echo $profile_picture; ?>" class="border border-gray-700" alt="">
                        <div class="mobile-user-info">
                            <div class="user-name-mobile"><?php echo $username; ?></div>
                            <div class="user-title"><?php echo $account_type; ?></div>
                        </div>
                    </div>
                    <div class="">
                        <a href="./login2.php"><button class=" w-1/3 p-2">Login</button></a>
                        <a href="./signup.php"><button class="interested w-20">Signup</button></a>
                    </div>
                </div>
                <div class="mobile-project-details  mt-1">
                    <div class="mobile-project-name"><?php echo $project_name; ?></div>
                    <div class="mobile-project-desc">
                       <?php echo $project_description; ?>
                    </div>
                </div>
            </div>
                    
            <?php include "./bottom_nav.php"; ?>
        </div>

        

        <div class="overlay">
            
            <div class="user-profile w-full p-4">
                <div class="left"> 
                    <div class="profile-pic">
                        <img src="./images/pri.jpg" alt="">
                    </div>
                    <div class="user-det">
                        <div class="name"><?php echo $username ?></div>
                        <div class="user-title"><?php echo $account_type ?></div>
                    </div>
                </div>
               
                <div class="btn">
                    <i class="si-bars"></i>
                </div>
            </div>

            <div class="model-views w-full p-4">
                <?php
                    for ($i=0; $i < count($model_images); $i++) {
                        if($i == 0){
                ?>
                    <div class="main-model-view">
                        <img src="./models/images/<?php echo $model_images[$i]; ?>" alt="">
                    </div>
                    <div class="other-views">
                <?php
                        }else{
                ?>
                        
                            <img src="./models/images/<?php echo $model_images[$i]; ?>" alt="">
                        
                <?php 
                        } 
                        
                    }
                ?>
                </div>
            </div>
            

            <div class="project-det w-full p-4 ">
                <div class="project-name"><?php echo $project_name ?></div>
                <div class="project-det"><?php echo $project_description ?></div>
            </div>

            <div class="btns px-4 flex justify-end gap-5">
                <a href="./login2.php"><button class=" w-1/3 p-2">Login</button></a>
                <a href="./signup.php"><button class="interested w-20">Signup</button></a>
            </div>
        </div>
        
    </div>
    
    <script>
        window.onload = function(){
            stopLoading();
        }
    </script>
    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@latest/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/"
            }
        }
    </script>
    <script type="module" src="main.js"></script>
    <script>
        


        // save current model
        let modelName = document.getElementById("model-name").value;
        function saveModelToBrowser(){
            let name = window.localStorage.getItem("model");
            console.log(name)
            if( name == null || name !== modelName){
                try{
                    window.localStorage.setItem("model", modelName);
                    window.localStorage.setItem("shared", "true");
                    console.log("saved model name");
                }catch(save_err){
                    console.log("error - failed to save model");
                }
            }else{
                console.log("no model was shared or is active");
            }
        }
        saveModelToBrowser();










        let loginTabOpened = false;
        let loginTab = document.getElementById("login-box");
        let userTab = document.getElementById("user-tab");
        let Btns = document.getElementById("btns-4");
        function loginBox(){
            if(loginTabOpened){
                loginTab.classList.remove("flex");
                loginTab.classList.add("hidden");
                loginTabOpened = false;
            }else{
                loginTab.classList.remove("hidden");
                loginTab.classList.add("flex");
                loginTabOpened = true;
            }
            console.log(loginTabOpened)
        }
        userTab.addEventListener("click", ()=>{
          loginBox();
        })

        Btns.addEventListener("click", ()=>{
            loginBox();
        })


    </script>





</body>
</html>
