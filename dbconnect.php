<?php
   $serverName = "localhost";
   $userName = "root";
   $password = "";
   $dbName = "arch2";

   if(!$con = mysqli_connect($serverName,$userName,$password,$dbName)){
     die("failed to connect");
   }

   
   
?>
