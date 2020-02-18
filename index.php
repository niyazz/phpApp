<?php require_once 'set.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Auth</title>	
</head>
<body>
	<form action="" method="POST">	
		<input class = "text" type="text" name="login" placeholder="Enter login">
		<input class = "text" type="password" name="pass" placeholder="Enter password">
		<?php if(isset($error))if($error) echo "<p>$error</p>" ?>
		<button type="submit" name="log">Log In</button>
		<button type="submit" name="reg">Registration</button>
	</form>

</body>
</html>