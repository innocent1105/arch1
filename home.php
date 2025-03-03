<?php 
	require("header.php");
	$user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>
	Hello, <?php echo $user_data['username']; ?>

	<img src="profile_pictures/<?php echo $user_data['pp'] ?>" alt="" width="120px">
</body>
</html>