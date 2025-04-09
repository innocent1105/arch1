<?php
    session_start();
    
    include("./connection.php");
    include("./functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // form submitted

        $username = stripslashes($_POST['username']);
        $password = stripslashes($_POST['password']);
		
        if(!empty($username) && !empty($password)){
            $user_id = random_num(10);
			$password = password_hash($password, PASSWORD_DEFAULT);
            $query = "insert into users (user_id,username, password) values ('$user_id','$username','$password')"; 
            mysqli_query($con, $query);

            $_SESSION['user_id'] =  $user_id;
            setcookie("xr", $user_id, time() + (86400 * 30), "/");
            header("Location: ./index.php");
        }else{
            echo "Please enter valid data";
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
</head>
<body>
    <?php include "./loading.php" ?>
    <?php include "./components/top-nav.php" ?>
    <div class="signup-box flex p-2">
        <form action="" method="post" class=" border bg-gray-900 rounded-lg px-4 shadow-lg w-96 mt-10">
            <div class=" text-2xl text-white mt-4 mb-3">Sign up</div>
            <label for="username">Username</label>
            <input type="text" class="p-2 bg-gray-800 text-white w-full border-0 transition-all hover:border-blue-500" name="username" id="username">
            <br>
            <label for="username">Password</label>
            <input type="text" class=" p-2 bg-gray-800 text-white w-full transition-all hover:border-blue-500" name="password" id="password">
            <br> <br>
            <input type="submit" class=" w-full text-white rounded-lg bg-blue-700 transition-all hover:bg-blue-900 py-2 cursor-pointer"  value="Submit" name="login">
            <br> <br>
            <a href="./login2.php">Login now</a>
            <br><br>
        </form>
    </div>

    <script>
        window.onload = function(){
            stopLoading();
        }
    </script>
</body>
</html>