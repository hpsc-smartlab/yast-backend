<?php
header('Content-Type: application/json');
require "init.php"; 

if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$lat 		= trim(stripslashes(htmlspecialchars($_POST["lat"]))); 
	$lng 		= trim(stripslashes(htmlspecialchars($_POST["lng"]))); 
	$indirizzo 	= trim(stripslashes(htmlspecialchars($_POST["indirizzo"]))); 
	$username   = trim(stripslashes(htmlspecialchars($_POST['username'])));
	$ruotini    = trim(stripslashes(htmlspecialchars($_POST['ruotini']))); 

	$query = "SELECT username FROM rider WHERE username = '".$username."'" ;
	$result = mysqli_query($conn,$query); 

	if (mysqli_num_rows ($result) > 0 ){
		$query = "UPDATE driver SET servizio='0' WHERE username='$username' ";
		$result = mysqli_query($conn,$query);
		$query = "UPDATE rider SET lat='$lat', lng='$lng', indirizzo='$indirizzo', servizio='1' WHERE username='$username' ";
		$result = mysqli_query($conn,$query); 
		$response = array(); 
		$code = "reg_true"; 
		$message = "Posizione aggiornata";
		array_push($response,array("code"=>$code,"message"=>$message));
		echo json_encode(array("server_response"=>$response)); 
	}
	else{
		$query = "UPDATE driver SET servizio='0' WHERE username='$username' ";
		$result = mysqli_query($conn,$query);
		$query = "INSERT INTO rider (lat,lng,indirizzo,username,servizio) VALUES ('$lat','$lng','$indirizzo','$username','1')";
		$result = mysqli_query($conn,$query); 

		if ( !$result ){
			$response = array(); 
			$code = "reg_false"; 
			$message = "Errore nel server2, riprovare"; 
			array_push($response,array("code"=>$code,"message"=>$message));
			echo json_encode(array("server_response"=>$response)); 
		}
		else{
			$response = array(); 
			$code = "reg_true"; 
			$message = "Posizione aggiornata"; 
			array_push($response,array("code"=>$code,"message"=>$message));
			echo json_encode(array("server_response"=>$response));	
		}


	}

	mysqli_close($conn); 

}

?>