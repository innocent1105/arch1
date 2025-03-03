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
                        $allowed_extensions = array("obj");
                        if(in_array($model_ex_lc, $allowed_extensions)){
                            $new_model_name = uniqid("model-", true).'.'.$model_ex_lc;
                            $upload_folder = 'models/'.$new_model_name;
                            move_uploaded_file($model_tmp_name,$upload_folder);

                              // images
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
                                            }else{
                                                // echo "File $filename failed.<br>";
                                            }
                                        }else{
                                            header("Location: upload_model.php?response= failed to upload images : unsupported format");
                                        }
                                    }else{
                                        header("Location: upload_model.php?response= failed to upload images : an error occuured");
                                    }
                                }
                                
                                $qry = "insert into projects(user_id,project_name,project_description, privacy,model_name,model_images) values ('$user_id', '$project_name', '$project_des','$privacy','$new_model_name','images_array')";
                                $result = mysqli_query($con, $qry);
                                if($result){
                                    // $encrepted_model_name = password_hash($new_model_name, true);
                                    header("Location: model_view.php?id=". $new_model_name. "");
                                }else{
                                    header("Location: upload_model.php?response=Error : an error occured, please try again.");
                                }
                            }else{
                                header("Location: upload_model.php?response=Failed to upload : no images selected.");
                            }


                        }else{
                            header("Location: upload_model.php?response=Error : Unsupported model format - select obj files only.");
                        }
                    }else{
                        header("Location: upload_model.php?response=Error : an error occured while uploading the model, please try again.");
                    }
                }else{
                    header("Location: upload_model.php?response=Please select a 3d model.");
                }
           }else{
                header("Location: upload_model.php?response=Error : project description can not be empty.");
           }
        }else{
            header("Location: upload_model.php?response=Error : project name can not be empty.");
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
	<title>My website</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tailwind.css">
    <link rel="stylesheet" href="css/icons.css">
</head>
<body>
<!-- 
	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>
	Hello, <?php echo $user_data['username']; ?>

	<img src="profile_pictures/<?php echo $user_data['pp'] ?>" alt="" width="120px"> -->


    <div class="mobile-bottom-bar">
        

            <div class="tabs">
                <div class="icons">
                    <div class="icon"><i class="si-message"></i></div>
                    <div class="icon"><i class="si-square"></i></div>
                    <div class="icon"><i class="si-user-circle"></i></div>
                </div>
            </div>
        </div>

    <div class="box mx-5 my-4 mb-7 flex justify-center">
        <div class="upload-box border p-4 rounded-lg">
           <b><div class="header text-2xl text-gray-200 my-4">Upload your 3D model</div></b> 
           <div class="error-box"><?php echo $response_msg ?></div>
            <form action="" method="post" class="text-gray-500" enctype="multipart/form-data">
                <label for="project-name">Project name</label>
                <input type="text" id="project-name" name="project-name"  class=" p-2 mt-1 bg-gray-900 text-white w-full text-sm transition-all hover:border-blue-500" placeholder="what is your project's name?">
                <br> <br>
                <label for="project-desc">Description</label>
                <input type="text" id="project-name" name="project-desc"  class=" p-2 mt-1 bg-gray-900 text-white w-full text-sm transition-all hover:border-blue-500" placeholder="Describe your project or 3d model.">
            
                <div class="privacy mt-4 mb-10">
                    <div class="t">Project privacy settings</div>
                    <select name="privacy" id="privacy" class=" w-full bg-gray-900 p-2 mt-1 rounded-md cursor-pointer">
                        <option value="Public" class="p-2">Public</option>
                        <option value="Private">Private (Invite only)</option>
                        <option value="only-me">Only me</option>
                    </select>
                    <div id="privacy-description" class="privacy-description ml-1 text-sm mt-4">
                        Public - This project can be viewed by everyone.
                    </div>
                </div>

                <div class="model mt-10 w-full">
                    <label for="model" id="model-btn" class=" model-btn w-full text-white rounded-lg shadow-md bg-gray-900 hover:bg-gray-800 transition-all cursor-pointer border border-dashed p-2 px-8">
                        Select 3d model
                    </label>
                    <input type="file" id="model" name="model" class=" hidden">
                </div>
                <br><br>
                <div class="images">
                <label for="pictures" id="files-btn" class=" model-btn w-full text-white rounded-lg shadow-md bg-gray-900 hover:bg-gray-800 transition-all cursor-pointer border border-dashed p-2 px-8">
                  Select pictures
                </label>
                    <input class="hidden" id="pictures" type="file" name="files[]" multiple>
                </div>

                <br><br>

                <input id="button" type="submit" class=" w-full text-white rounded-lg bg-blue-700 transition-all hover:bg-blue-900 py-2 cursor-pointer" value="Publish"><br><br>




            </form>
        </div>
    </div>

    
   

<script>
    let privacyDesTab = document.getElementById("privacy-description");
    let privacy = document.getElementById("privacy");
    
    privacy.addEventListener("change", ()=>{
        if(privacy.value == "Public"){
            privacyDesTab.innerHTML = "Public - This project can be viewed by everyone.";
        }else if(privacy.value == "Private"){
            privacyDesTab.innerHTML = "Private - This project can only be viewed by invited users. Use the link to invite.";
        }else if(privacy.value == "only-me"){
            privacyDesTab.innerHTML = "Only me - This project will only be viewed by me.";
        }else{
            privacyDesTab.innerHTML = "-";
        }
    })

    let modelBtn = document.getElementById("model-btn");
    let model = document.getElementById("model");
    model.addEventListener("change", ()=>{
        let fileName = model.value;
        modelBtn.innerHTML = fileName.slice(0,12) + "...";
    })

    let pictures = document.getElementById("pictures");
    let filesBtn = document.getElementById("files-btn");

    pictures.addEventListener("change", ()=>{
        let imagesName = pictures.value;
        filesBtn.innerHTML = imagesName.slice(0,12) + "...";
    })





</script>






</body>
</html>