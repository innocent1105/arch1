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

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // form submitted

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(!empty($username) && !empty($password)){
            // read from db
            // $user_id = random_num(10000000);
            $query = "select * from users where username = '$username' limit 1"; 
            $result = mysqli_query($con, $query);
            if($result){
                if($result && mysqli_num_rows($result) > 0 ){
                    $user_data = mysqli_fetch_assoc($result);
                    // return $user_data;
                    if(password_verify($password ,$user_data['password'])){
                        $_SESSION['user_id'] = $user_data['user_id'];
                        setcookie("xr", $user_data['user_id'], time() + (86400 * 30), "/");
                        header("Location: ./index.php");
                        // echo "logged in";
                        die;
                    }else{
                        header("Location: ./login.php?error='3'");
                    }
                }else{
                    header("Location: ./login.php?error='2'");
                }
            }
        }else{
            header("Location: ./login.php?error='1'");
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Three</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/icons.css">
    <style>
       
    </style>
</head>
<body>
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
                <div class="mobile-main-view">
                    <img src="./images/1.png" class="border border-gray-700" alt="">
                </div>
                <div class="mobile-other-views">
                    <img src="./images/2.png" class="border border-gray-800" alt="">
                    <img src="./images/3.png" class="border border-gray-800" alt="">
                    <img src="./images/4.png" class="border border-gray-800" alt="">
                    <img src="./images/3.png"  class="border border-gray-800"alt="">
                </div>

            </div>

        </div>

        <div class="mobile-bottom-bar">
            <div id="user-tab" class="user-details w-full  p-2">
                <div class="mobile-user ">
                    <div class="user-left">
                        <img src="./images/pri.jpg" class="border border-gray-700" alt="">
                        <div class="mobile-user-info">
                            <div class="user-name-mobile">Priscilla</div>
                            <div class="user-title">3D designer</div>
                        </div>
                    </div>
                    <div class="">
                        <button class="btn bg-blue-700 hover:bg-blue-900 transition-all">Interested</button>
                    </div>
                </div>
                <div class="mobile-project-details  mt-1">
                    <div class="mobile-project-name">Street bar design</div>
                    <div class="mobile-project-desc">
                        A 3D design of a street bar. A 3D design of a street bar. A 3D design of a street bar
                        A 3D design of a street bar. A 3D design of a street bar. A 3D design of a street bar
                        A 3D design of a street bar. A 3D design of a street bar. A 3D design of a street bar
                        A 3D design of a street bar. A 3D design of a street bar. A 3D design of a street bar

                    </div>
                </div>
            </div>

            <div class="tabs">
                <div class="icons">
                    <div class="icon"><i class="si-message"></i></div>
                    <div class="icon"><i class="si-square"></i></div>
                    <div class="icon"><i class="si-user-circle"></i></div>
                </div>
            </div>
        </div>
        
        <?php if($error_response != ""){
            ?>
            <div id="login-box" class="login-box p-2 pt-48 flex w-full">
            <?php include "./components/login.php"; ?>
        </div>
        <?php }?>
        <div id="login-box" class="login-box p-2 pt-48 hidden w-full">
            <?php include "./components/login.php"; ?>
        </div>
        <div class="overlay">
            <div class="user-profile w-full p-4">
                <div class="left"> 
                    <div class="profile-pic">
                        <img src="./images/pri.jpg" alt="">
                    </div>
                    <div class="user-det">
                        <div class="name">Priscilla</div>
                        <div class="user-title">3D designer</div>
                    </div>
                </div>
               
                <div class="btn">
                    <i class="si-bars"></i>
                </div>
            </div>

            <div class="model-views w-full p-4">
                <div class="main-model-view">
                    <img src="./images/1.png" alt="">
                </div>
                <div class="other-views">
                    <img src="./images/2.png" alt="">
                    <img src="./images/3.png" alt="">
                    <img src="./images/4.png" alt="">
                    <img src="./images/3.png" alt="">
                </div>
            </div>

            <div class="project-det w-full p-4 ">
                <div class="project-name">Downtown bar</div>
                <div class="project-det">A street bar, incomplete and neglected.</div>
            </div>

            <div id="btns-4" class="btns px-4">
                <button class="save-btn w-1/3">save</button>
                <button class="interested">Interested</button>
            </div>
        </div>
    </div>
    <script type="module" src="main.js"></script>
    <script>
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
