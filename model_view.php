<?php 
	require("header.php");
	$user_data = check_login($con);

    $response_msg = "";

    if(isset($_GET['id'])){
        $model_id = $_GET['id'];
        echo $model_id;
    }else{

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
<body><input type="text" id="model-name" class=" hidden" value="<?php echo $model_id ?>">
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
            <div class="user-details w-full  p-2">
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

            <div class="btns px-4">
                <button class="save-btn w-1/3">save</button>
                <button class="interested">Interested</button>
            </div>
        </div>
    </div>
    
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.172.0/three.tsl.js" type="module"></script> -->
    <!-- <script src="http://threejs.org/build/three.min.js" type="module"></script> -->

    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@latest/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/"
            }
        }
    </script>


    <script type="module" src="main.js"></script>
</body>
</html>
