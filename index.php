<?php 
	require("header.php");
	$user_data = check_login($con);
	header("Location: ./model_view.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Realism Studio</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>
	Hello, <?php echo $user_data['username']; ?>

	<img src="profile_pictures/<?php echo $user_data['pp'] ?>" alt="" width="120px">
</body>
</html>