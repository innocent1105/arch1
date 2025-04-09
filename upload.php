<?php 
	require("header.php");
	$user_data = check_login($con);
    $user_id = $user_data['user_id'];

    $response_msg = "";
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $project_name = stripslashes($_POST['project-name']);
        $project_des = stripslashes($_POST['project-desc']);
        $privacy = stripslashes($_POST['privacy']);

        if(!empty($project_name)){
           if(!empty($project_des)){
                // model
                if(isset($_FILES['model']) && !empty($_FILES['model']['name'])){
                    $model_name = $_FILES['model']['name'];
                    $model_tmp_name = $_FILES['model']['tmp_name'];
                    $error = $_FILES['model']['error'];
        
                    if($error === 0){
                        $model_ex = pathinfo($model_name, PATHINFO_EXTENSION);
                        $model_ex_lc = strtolower($model_ex);
        
                        // $allowed_extensions = array("glb", "gltf", "obj", "fbx", "stl", "ply", "3ds", "dae", "blend", "max", "c4d", "ma", "mb", "ma", "mb");
                        $allowed_extensions = array("glb");
                        if(in_array($model_ex_lc, $allowed_extensions)){
                            $new_model_name = uniqid("model-", true).'.'.$model_ex_lc;
                            $upload_folder = 'models/'.$new_model_name;
                            move_uploaded_file($model_tmp_name,$upload_folder);

                              // images
                            $images_array = array();
                            if(isset($_FILES['files']) && !empty($_FILES['files'])){
                                foreach($_FILES['files']['tmp_name'] as $key => $tmpName){
                                    if($_FILES['files']['error'][$key] === UPLOAD_ERR_OK){
                                        $filename = basename($_FILES['files']['name'][$key]);
                                        $targetFilePath = 'models/images/'. $filename;
                                        $file_ex = pathinfo($filename, PATHINFO_EXTENSION);
                                        $extensions = array('png', 'jpg', 'jpeg');
                                        
                                        if(in_array($file_ex, $extensions)){
                                            if(move_uploaded_file($tmpName,$targetFilePath)){
                                                // echo "File $filename uploaded. <br>";
                                                array_push($images_array, $filename);
                                            }else{
                                                // echo "File $filename failed.<br>";
                                            }
                                        }else{
                                            header("Location: upload.php?response= failed to upload images : unsupported format");
                                        }
                                    }else{
                                        header("Location: upload.php?response= failed to upload images : an error occuured");
                                    }
                                }
                                
                                $images_array = json_encode($images_array);
                                $qry = "insert into projects(user_id,project_name,project_description, privacy,model_name,model_images) values ('$user_id', '$project_name', '$project_des','$privacy','$new_model_name','$images_array')";
                                $result = mysqli_query($con, $qry);
                                if($result){
                                    // $encrepted_model_name = password_hash($new_model_name, true);
                                    header("Location: model_view.php?id=". $new_model_name. "");
                                }else{
                                    header("Location: upload.php?response=Error : an error occured, please try again.");
                                }
                            }else{
                                header("Location: upload.php?response=Failed to upload : no images selected.");
                            }


                        }else{
                            header("Location: upload.php?response=Error : Unsupported model format - select glb files only.");
                        }
                    }else{
                        header("Location: upload.php?response=Error : an error occured while uploading the model, please try again.");
                    }
                }else{
                    header("Location: upload.php?response=Please select a 3d model.");
                }
           }else{
                header("Location: upload.php?response=Error : project description can not be empty.");
           }
        }else{
            header("Location: upload.php?response=Error : project name can not be empty.");
        }
    }

    if(isset($_GET['response'])){
        $response_msg = $_GET['response'];
        $response_msg = '
            <div class="error-msg w-full p-2 border border-red-500 text-red-500 text-xs rounded">
            ' . $response_msg . 
            ' </div>'
        ;

    }
    





?>

<!DOCTYPE html>
<html>
<head>
	<title>Realism Studio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/icons.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tailwind.css">
</head>
<body>
    <?php include "./loading.php" ?>
    <?php include "./components/top-nav.php" ?>

    

    <div class="mobile-bottom-bar">
        
        <?php include "./bottom_nav.php" ?>

            
    </div>

    <div class="flex justify-center">
        <div class="upload-box p-2 mt-14">
            <div class="top w-full flex gap-2 my-2">
                <div class="profile-pic pt-2">
                    <img class="w-8 h-8 object-fit-cover rounded-full" src="profile_pictures/<?php echo $user_data['pp'] ?>" alt="" width="120px"> 
                </div>
                <div class="active-user-det p-2 w-full flex  gap-2 justify-between">
                    <div class="username text-sm text-gray-300 pt-2"><?php echo $user_data['username'];?></div>
                    <!-- <div class="user-action-btn p-2 bg-gray-900 rounded hover:bg-gray-700 transition-all"><i class="si-bars "></i></div> -->
                </div>
                
            </div>

            <div class="error-box my-2"><?php echo $response_msg ?></div>


        <form action="" method="post" enctype="multipart/form-data">
        
            <!-- <label for="project-name" class=" text-sm text-gray-300"></label> -->
            <input type="text" name="project-name" class="w-full bg-gray-900 rounded-md p-2 transition-all" placeholder="Project name">
            <textarea name="project-desc" id="" class=" w-full h-36 resize-none rounded-md bg-gray-900 p-2 mt-2 transition-all outline-blue-700" placeholder="Drescribe your project"></textarea>
            
            <div class="privacy">
                <select id="privacy" name="privacy" class=" w-full bg-gray-900 p-2 mt-1 rounded-md cursor-pointer">
                    <option value="Public" class="p-2">Public</option>
                    <option value="Private"> Private (Invite only)</option>
                    <option value="only-me">Only me</option>
                </select>
                <div id="privacy-description" class="privacy-description ml-1 text-sm mt-4">
                    <i class="si-globe"></i> Public - This project can be viewed by everyone.
                </div>
            </div>
            
            <div class="buttons  mt-2  w-full flex justify-between">
                <div class="left mt-2">
                    <label for="model" id="model-btn" class="model text-sm w-full bg-gray-900 text-blue-300 rounded p-2 px-5">Select 3d model</label>
                    <input type="file" name="model" id="model" class="hidden">
                </div>
                <div class="right p-2 rounded-md hoverL:bg-gray-900 transition-all">
                    <label for="pictures" id="files-btn">
                        <div class="images text-xl rounded-md flex justify-between  cursor-pointer hover:bg-gray-900 text-green-500">
                            <i class="si-image"></i>
                            <div id="images-text" class="text text-sm text-green-500">Add images</div>
                        </div>
                    </label>
                    
                    <input class="hidden" id="pictures" type="file" name="files[]" multiple required>
    
                </div>
            </div> 

            <div class="new-upload-btn hidden mt-8" id="submit-btn-tab">
                <input id="button" type="submit" class=" px-8 text-white rounded-lg bg-blue-700 transition-all hover:bg-blue-900 py-2 cursor-pointer" value="Publish"><br><br>
            </div>
        </form>   




        </div>
    </div>

    
   

<script>
    window.onload = function(){
        stopLoading();
        setTimeout(() => {
            document.getElementById("submit-btn-tab").style.display = "block"; 
        }, 2000);
    }

    let privacyDesTab = document.getElementById("privacy-description");
    let privacy = document.getElementById("privacy");
    
    privacy.addEventListener("change", ()=>{
        if(privacy.value == "Public"){
            privacyDesTab.innerHTML = `<i class="si-globe"></i> Public - This project can be viewed by everyone.`;
        }else if(privacy.value == "Private"){
            privacyDesTab.innerHTML = `<i class="si-lock"></i> Private - This project can only be viewed by invited users. Use the link to invite.`;
        }else if(privacy.value == "only-me"){
            privacyDesTab.innerHTML = `<i class="si-eye-slash"></i> Only me - This project will only be viewed by me.`;
        }else{
            privacyDesTab.innerHTML = "-";
        }
    })

    let modelBtn = document.getElementById("model-btn");
    let model = document.getElementById("model");
    model.addEventListener("change", ()=>{
        let fileName = model.value;
        console.log(fileName);
        modelBtn.innerHTML = fileName.slice(0,12) + "...";
    })

    let pictures = document.getElementById("pictures");
    let filesBtn = document.getElementById("files-btn");

    pictures.addEventListener("change", ()=>{
        let imagesName = [pictures.value];
        console.log(imagesName);
        document.getElementById("images-text").innerHTML = "Images added...";
    })





</script>






</body>
</html>