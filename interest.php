<?php 

    require("header.php");

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $rawData = file_get_contents('php://input');

        // Decode the JSON data
        $data = json_decode($rawData, true);
        $user_id = $data['userId'];
        $model_id = $data['model'];
        // echo $data['model'];

        $query = "select * from interests where user_id = '$user_id' and model_id = '$model_id' limit 1";
        $result = mysqli_query($con, $query);

        if($result->num_rows > 0){
            $query = "delete from interests where user_id = '$user_id' and model_id = '$model_id' limit 1";
            $qry = mysqli_query($con, $query);
            if($qry){   
                echo "uninterested";
            }else{
                echo "error";
            }
        }else{
            $qry = "insert into interests (user_id, model_id, interest) values('$user_id', '$model_id', '1')";
            $result = mysqli_query($con, $qry);
            if($result){
                echo "success";
            }else{
                echo "error";
            }
        } 
    }

?>