<?php 

	require_once 'connection.php';
	require_once 'sender.php';
	session_start();
	$header = '';
	$senders = [];
	$used_data = [];;

	if(isset($_SESSION['user_id'])){
		$user_id = $_SESSION['user_id'];
	}

	$connection = mysqli_connect($host, $user, $password, $database) 
       			 or die("Ошибкаqqq: " . mysqli_error($connection)); 
	$query = "SELECT * FROM messages WHERE to_id = '$user_id'";
	$responce_message = mysqli_query($connection,$query) or die("Ошибкаiii: " . mysqli_error($connection));

	for($i = 0; $i < mysqli_num_rows($responce_message); $i++){
		$sender = new Sender();
		$data = mysqli_fetch_assoc($responce_message);
			$sender->sender_id = $data['from_id'];


			$query2 = "SELECT name FROM users WHERE user_id = $sender->sender_id";
			$responce_name = mysqli_query($connection,$query2) or die("Ошибкаzs: " . mysqli_error($connection));
			$data2 = mysqli_fetch_assoc($responce_name);
			$sender->sender_name = $data2['name'];

			if(!in_array($sender, $senders))
			$senders[$i] = $sender;
	
	}
	mysqli_data_seek($responce_message, 0);
	for ($k=0; $k < mysqli_num_rows($responce_message); $k++) { 
		$data3 = mysqli_fetch_assoc($responce_message);
		$cur_mes = $data3['text'];
		$cur_id = $data3['from_id'];
		for ($o=0; $o < count($senders); $o++) { 
			$cur_sender = $senders[$o]->sender_id;
			if($cur_sender == $cur_id){
				array_push($senders[$o]->sender_messages, $cur_mes);
			}
		}
	}
		
	

	
  ?>