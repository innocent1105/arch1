<?php 

session_start();

	include("connection.php");
	include("functions.php");
    
    // $error_response = "";
    if(isset($_GET['error'])){
        $error_response = $_GET['error'];
        if($error_response == "'error-1'"){
            $error_response = '
            <div class="error-msg w-full p-2 border border-red-500 text-red-500 text-xs rounded">
                Please fill in all the fields.
            </div>
        ';
        }else if($error_response == "'error-2'"){
            $error_response = '
            <div class="error-msg w-full p-2 border border-red-500 text-red-500 text-xs rounded">
                Incorrect password
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
		//something was posted
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password)){

			//read from database
			$query = "select * from users where username = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result -> num_rows > 0){
                while($user_data = $result->fetch_assoc()){
                    if(password_verify($password ,$user_data['password'])){
						$_SESSION['user_id'] =  $user_data['user_id'];
						setcookie("xr", $user_data['user_id'], time() + (86400 * 30), "/");
						header("Location: index.php");
						die;
					} 
                }
			}
            $error = "error-2";
            header("Location: login2.php?error='$error'");
		}else{
            $error = "error-1";
			header("Location: login2.php?error='$error'");
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
    <body>
        <?php include "./loading.php" ?>
        <?php include "./components/top-nav.php" ?>
            <div id="login-box" class="login-box p-2 pt-48 flex w-full">
                <?php include "./components/login.php"; ?>
            </div>

            
        <script>
            window.onload = function(){
                stopLoading();
            }
        </script>
    </body>
</html>