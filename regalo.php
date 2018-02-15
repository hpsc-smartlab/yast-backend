<?php
header('Content-Type: application/json');
require "init.php"; 

if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$email 		= trim(stripslashes(htmlspecialchars($_POST["email"]))); 
	$regalo 	= trim(stripslashes(htmlspecialchars($_POST["regalo"])));

	$query = "SELECT * FROM regalo WHERE email = '".$email."'" ;
	$result = mysqli_query($conn,$query); 

	if (mysqli_num_rows ($result) > 0 ){
		$response = array(); 
		$code = "regalo_false"; 
		$message = "Hai già ricevuto per oggi il tuo regalo, torna tra un mese :)"; 
		array_push($response,array("code"=>$code,"message"=>$message));
		echo json_encode(array("server_response"=>$response)); 
	}
	else{
		$giorno = date("Y-m-d");
		$query = "INSERT INTO regalo (email,qnt,giorno) VALUES ('$email','$regalo','$giorno')";
		$result = mysqli_query($conn,$query); 
		$query = "INSERT INTO bitwheels (nome,bitwheel,data_ora) VALUES ('$email','$regalo',NOW())";
		$result = mysqli_query($conn,$query); 

		if ( !$result ){
			$response = array(); 
			$code = "reg_false"; 
			$message = "Errore nel server, riprovare"; 
			array_push($response,array("code"=>$code,"message"=>$message));
			echo json_encode(array("server_response"=>$response)); 
		}
		else{
			$response = array(); 
			$code = "regalo_true"; 
			$message = "Sorridi, hai ricevuto ".$regalo." BitWheels :)"; 
			array_push($response,array("code"=>$code,"message"=>$message));
			echo json_encode(array("server_response"=>$response));	
		}


	}

	mysqli_close($conn); 

}




?>