<?php 
	require("header.php");
	$user_data = check_login($con);

    $response_msg = "";

    if(isset($_GET['id'])){
        $model_id = $_GET['id'];
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
                $model_images = json_decode($model_images, true);
                $model_name = $model_id;
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
    <title>Three</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/icons.css">
    <style>
       .lol{
            width: 70%;
       }
    </style>
</head>
<body><input type="text" id="model-name" class=" hidden" value="<?php echo $model_name ?>">
    <!-- <?php include "./loading.php" ?> -->


    <div class="container" id="container">
        <div class="mobile-top-bar mt-10 ">
            <!-- <div class="search-section">
                 <div class="search-bar">
                    <input type="text">
                </div> 
                <div class="search-icon">
                    <i class="si-search"></i>
                </div>
            </div> -->
            <div id="images-preview-btn" class="images-preview-btn text-2xl p-1 px-2 m-2 border border-gray-700 text-gray-500 rounded-md ">
                <i class="si-image"></i>
            </div>


            <div id="mobile-images-section" class="mobile-model-views hidden">
                <?php
                    if(count($model_images) > 0){
                        for ($i=0; $i < count($model_images); $i++) {
                            if($i == 0){
                            ?>
                                <div class="mobile-main-view">
                                    <img src="./models/images/<?php echo $model_images[$i]; ?>" class="border border-gray-700" alt="">
                                </div>
                                <div class="mobile-other-views">
                            <?php
                            }
                            if(count($model_images) > 1){
                                ?>
                                    <img src="./models/images/<?php echo $model_images[$i]; ?>" class="border border-gray-800" alt="">
                                <?php
                            }
                        }
                    }
                        
                ?>
                </div>

            </div>

        </div>

        <div class="mobile-bottom-bar transition-all">
            <div class="user-details w-full transition-all p-2">
                <div class="mobile-user transition-all px-2">
                    <div class="user-left">
                        <img src="./profile_pictures/<?php echo $profile_picture; ?>" class="border border-gray-700" alt="">
                        <div class="mobile-user-info">
                            <div class="user-name-mobile"><?php echo $username; ?></div>
                            <div class="user-title"><?php echo $account_type; ?></div>
                        </div>
                    </div>
                    <div class="">
                        <a href="./chat.php?id=<?php echo $user_id ?>"><button id="interested" class="btn bg-blue-700 hover:bg-blue-900 transition-all">Interested</button></a>
                    </div>
                </div>
                <div class="mobile-project-details transition-all px-2 mt-4">
                    <div class="mobile-project-name"><?php echo $project_name; ?></div>
                    <div id="des-area" class="mobile-project-desc transition-all">
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

            <div class="btns px-4">
                <button class="save-btn w-1/3">save</button>
                <button class="interested">Interested</button>
            </div>
        </div>

        <div id="overlay2" class="overlay2">
            <div class="desktop-main-top-bar flex justify-between gap-2">
                <div class="main-logo m-2">
                    <div class=" flex gap-2 ">
                        <div class="logo w-7 h-7 rounded-md bg-white "></div>
                        <div class="logo-text text-white pt-1 text-md">Realism</div>
                    </div>
                </div> 

                <div class="right-top-bar flex gap-2 ">
                    <div class="lol">
                        <input id="desktop-search-input" type="text" class="desktop-search-input p-2 px-4 transition-all w-full outline-none focus:shadow text-sm" placeholder="start typing...">
                    </div>
                    <div class="flex">
                        <div id="desktop-search-btn" class=" desktop-search-icon hover:shadow cursor-pointer p-2 px-3 rounded-md transition-all">
                            <i class="si-search"></i>
                        </div>

                        <!-- upload model -->
                        <a href="upload.php">
                            <div class=" desktop-search-icon hover:shadow cursor-pointer p-2 px-3 rounded-md transition-all">
                                <i class="si-stop"></i>
                            </div>
                        </a>

                        <a href="profile.php">
                            <div class=" desktop-search-icon hover:shadow cursor-pointer p-2 px-3 rounded-md transition-all">
                                <i class="si-user-circle"></i>
                            </div>
                        </a>
                    </div>
                    

                </div>
            </div>

            <div id="desktop-search-results" class="desktop-search-results hidden p-2 mt-2">
                <div id="search-area2" class="search-bar w-full mt-2">
                    <div class="results w-full mt-2">
                        <div class="text-w text-sm text-gray-700 px-2">Search results</div>
                        <div id="search-results2" class="result w-full p-2 rounded-md mt-1 animate-pulse">

                        </div>
                    </div>
                </div>
            </div>
        </div>





    </div>
   
    <div class="desktop-top-nav">
        <?php include "./components/top-nav.php" ?>
    </div>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.172.0/three.tsl.js" type="module"></script> -->
    <!-- <script src="http://threejs.org/build/three.min.js" type="module"></script> -->

    <script>
        let searchDesktopInput = document.getElementById("desktop-search-input");
        let desktopResultsTab = document.getElementById("desktop-search-results");
        let resultsArea2 = document.getElementById("search-results2");
        let searchDesktopBtn = document.getElementById("desktop-search-btn");

        let overlay2 = document.getElementById("overlay2");

        searchDesktopInput.addEventListener("focus", ()=>{
            desktopResultsTab.style.display = "block";
            searchDesktopInput.style.width = "70%";
        })
        searchDesktopInput.addEventListener("click", ()=>{
            desktopResultsTab.style.display = "block";
            searchDesktopInput.style.width = "70%";
        })

        desktopResultsTab.addEventListener("mouseover", ()=>{
            desktopResultsTab.style.display = "block";
            searchDesktopInput.style.display = "block";
             searchDesktopInput.style.width = "70%";
        })

        overlay2.addEventListener("mouseover", ()=>{
            desktopResultsTab.style.display = "block";
            searchDesktopInput.style.display = "block";
            searchDesktopInput.style.width = "70%";
        })

        desktopResultsTab.addEventListener("mouseout", ()=>{
            desktopResultsTab.style.display = "none";
            searchDesktopInput.style.display = "none";
            searchDesktopInput.style.width = "0%";
        })

        searchDesktopBtn.addEventListener("click", ()=>{
            searchDesktopInput.style.width = "70%";
            searchDesktopInput.style.display = "block";
            searchDesktopInput.focus();
        })

    












        


        searchDesktopInput.addEventListener("input", ()=>{
            let searchQuery = searchDesktopInput.value;
            if(searchQuery.length < 1){
                resultsArea2.classList.add("animate-pulse");
            }else{
                resultsArea2.classList.remove("animate-pulse");
            }



            $.ajax({
                type: "POST",
                url: "./search.php",
                data: {
                    "search" : searchQuery
                },
                beforeSend: ()=>{
                    // resultsArea.classList.add("animate-pulse bg-gray-900");
                    resultsArea2.innerHTML = "Please wait ... ";
                },
                success: (response)=>{
                    resultsArea2.innerHTML = response;
                },
                error: (error)=>{
                    console.log(error)
                }
            })
            // console.log("search")
        })
    </script>


    <script>
        // window.onload = function(){
        //     stopLoading();
        // }
    </script>
    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@latest/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@latest/examples/jsm/"
            }
        }
    </script>

    <script type="module" src="./js/jquery.js"></script>
    <script type="module" src="main.js"></script>
    <script>
        
        let desArea = document.getElementById("des-area");
        let desAreaOpened = false;
            desArea.addEventListener("click", ()=>{
                if(desAreaOpened){
                    desArea.style.height = "70px";
                    desAreaOpened = false;
                }else{
                    desArea.style.height = "auto";
                    desAreaOpened = true;
                }
            })



        let images_preview_btn = document.getElementById("images-preview-btn");
        let imagesTab = document.getElementById("mobile-images-section");  
        images_preview_btn.addEventListener("click", ()=>{
            images_preview_btn.style.display = "none";
            imagesTab.style.display = "flex";
        })

        images_preview_btn.addEventListener("mouseout", ()=>{
            images_preview_btn.style.display = "block";
            imagesTab.style.display = "none";
        })  

        imagesTab.addEventListener("mouseout", ()=>{
            images_preview_btn.style.display = "block";
            imagesTab.style.display = "none";
        })  

        imagesTab.addEventListener("mouseover", ()=>{
            images_preview_btn.style.display = "none";
            imagesTab.style.display = "flex";
        })


        let interestedBtn = document.getElementById("interested");
        let userId = 2213;
        let modelId = document.getElementById("model-name").value;
            interestedBtn.addEventListener("click", ()=>{
                let data = {
                        "userId" : userId,
                        "model": modelId,
                        "interest ": 1
                    }
                    data = JSON.stringify(data);
                $.ajax({
                    type: "POST",
                    url:"interest.php",
                    data: data,
                    beforeSend: ()=>{
                        interestedBtn.innerHTML = "loading...";
                        interestedBtn.setAttribute("disabled", "true");
                    },
                    success: (response)=>{
                        if(response === "success"){
                            interestedBtn.innerHTML = "Interested";
                            interestedBtn.removeAttribute("disabled");
                            console.log(response)   
                        }else if(response === "uninterested"){
                            interestedBtn.innerHTML = "Uninterested";
                            interestedBtn.removeAttribute("disabled");
                            console.log(response)
                        }else{
                            interestedBtn.innerHTML = "error";
                            interestedBtn.removeAttribute("disabled");
                            console.log(response)
                        }
                        console.log(response)
                    },
                    error: (error)=>{
                        console.log(error);
                    }
                })
            })
    // get current model
    
    </script>
</body>
</html>




















