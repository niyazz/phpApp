<head>
<link rel="stylesheet" href="main.css">
</head>
<?php require_once 'connection.php';
	  require_once 'messa.php' ?>
<div class = page>

	<div class = "container">
		<form method="GET">
		<?php 
			for($i = 0; $i < count($senders); $i++){
				$name = $senders[$i]->sender_name;
				$id = $senders[$i]->sender_id;
				$mess = count($senders[$i]->sender_messages);
				echo "<button name = $id>$name $mess<button>";
			}
		 ?>
		</form>
	</div>

	<div class = "container">
	<?php 


		$ar = array_keys($_GET)[0];
		if(isset($_GET[$ar])){
			for($k = 0; $k < count($senders); $k++){
				if($senders[$k]->sender_id === strval($ar)){
					$mes = $senders[$k]->sender_messages;
					$names = $senders[$k]->sender_name;
					for ($q = 0; $q < count($mes); $q++) { 
						echo "<div class = 'message'>
						<label>".$names."</label>
						<p>".$mes[$q]."</p>
					  </div>";
					}
					
				}
			}

		}
	 ?>

	<form method = "POST">
		<textarea name="mesq" placeholder = "Text message"></textarea>
		<button name = "sub_mes" type="submit">Send</button>
	</form>
</div>
<?php 



	$i = random_int(100, 999);
	if(isset($_POST['sub_mes'])){
		$message = $_POST['mesq'];
		
		$query3 = "INSERT INTO messages VALUES($i,'$user_id','$ar','$message')";
		$responce = mysqli_query($connection,$query3) or die("Ошибкаwe: " . mysqli_error($connection));	
		echo "<meta http-equiv='refresh' content='0'>";
	}
 ?>
 <a class = "container" href = "exit.php">Exit</a>
</div>