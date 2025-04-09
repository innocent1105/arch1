
<div class="section-text p-2 text-sm border-t border-gray-900 mt-4 text-gray-500"> People</div>

<?php
    require "./header.php";

    $search = $_POST['search'];
    $qry = "select * from users where username like '%{$search}%' limit 5";
    $result = mysqli_query($con, $qry);

    if(!empty($search)){
        if($result -> num_rows > 0){
            while($row = $result->fetch_assoc()){
        ?>
            <a href="./chat.php?id=<?php echo $row['user_id']?>" class="search-result-box w-full">
                <div onclick="currentUser(<?php echo $row['user_id'] ?>)" class="w-full my-2 p-2 rounded-md flex gap-2 active:scale-95 cursor-pointer transition-all ">
                    <img class=" w-10 h-10 rounded-full object-fit-cover" src="./profile_pictures/<?php echo $row['pp'] ?>" alt="">
                    <div class="user-det">
                        <div class="username text-md"><?php echo $row['username'] ?></div>
                        <div class="message text-sm text-gray-500"><?php echo $row['account_type'] ?></div>
                    </div>
                </div>
            </a>
        <?php
            }
        }else{
        ?>
            <div class=" rounded-md p-2 px-4 text-medium text-gray-500"> ...</div>
        <?php
        }
    }else{
    ?>
        <div class="text-medium text-gray-500">...</div>
    <?php
    }
    ?>

    <div class="section-text p-2 text-sm mt-4 text-gray-500"> Models</div>

    <?php
    

    // models search
    $qry = "select * from projects where project_name or project_description like '%{$search}%' limit 10";
    $result = mysqli_query($con, $qry);

    if($result -> num_rows > 0){
        while($row = $result->fetch_assoc()){
            $project_name = $row['project_name'];
    ?>
        <a href="./model_view.php?id=<?php echo $row['model_name']?>" class="search-result-box w-full">
            <div onclick="currentUser(<?php echo $row['user_id'] ?>)" class="user w-full my-2 p-2 rounded-md flex gap-2 active:scale-95 cursor-pointer transition-all ">
                <img class=" w-10 h-10 rounded-md border shadow object-fit-cover" src="./images/1.png" alt="">
                <div class="user-det">
                    <div class="username text-md"><?php echo $row['project_name'] ?></div>
                    <div class="message text-sm text-gray-500"><?php echo $row['project_description'] ?></div>
                </div>
            </div>
        </a>
    <?php
        }
    }else{
        ?>
           <div class="border rounded-md p-2 px-4 text-medium text-gray-500"> No results much your search...</div>
        <?php
    }






?>



































