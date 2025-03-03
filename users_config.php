<?php

if(isset($_COOKIE['Logged'])){
    header("Location: ./home.php");
}
$user_data = check_login($con);



?>