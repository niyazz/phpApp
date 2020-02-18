
<?php 
/*data for connecting*/
	require_once 'connection.php'; 
	session_start(); 

/*if user logined throw him to his page,
	 unless he wiil press 'Exit': */
	if(isset($_SESSION['user_id'])){ 
		header("Location: login.php");
		exit;
	}

/*if its tryining to log in:*/
	if(isset($_POST['log'])){
		$error = '';
		if(isset($_POST['login']) && isset($_POST['pass'])){
			$login = htmlentities($_POST['login']);
			$pass = htmlentities($_POST['pass']);
			if($login === '' || $pass === '')
   				$error = 'Match all fields.';
		}

	/*connect to database and find user with $_posted login and password:*/
		$connection = mysqli_connect($host, $user, $password, $database) 
        or die("Ошибка: " . mysqli_error($connection)); 
    	$query = "SELECT * FROM users WHERE name = '$login' AND password = '$pass'";
   		$responce = mysqli_query($connection,$query) or die("Ошибкаsas: " . mysqli_error($connection));

   	/*if user found -> save his id fro session and throw to his page, if not -> say error:*/
   		if (mysqli_num_rows($responce) === 1){
   			$row = mysqli_fetch_assoc($responce);
   			$_SESSION['user_id'] = $row['user_id'];	 
   			mysqli_close($connection);	
   			header("Location: login.php");		
  		}
   		else{
   			 $error = 'User with this name does not exists.';
   		}
}
 ?>
