<?php
header('Content-Type: application/json');
require "init.php"; 

if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$esito				 = trim(stripslashes(htmlspecialchars($_POST["esito"]))); 
	$usernamePasseggero  = trim(stripslashes(htmlspecialchars($_POST["usernamePasseggero"]))); 
	$usernameAutista	 = trim(stripslashes(htmlspecialchars($_POST["usernameAutista"])));
	$costoCorsa 		 = trim(stripslashes(htmlspecialchars($_POST["costoCorsa"])));
	
	if ( $esito == 1 ){
		$query = "UPDATE corsa SET esito='1' WHERE nomePasseggero='$usernamePasseggero' ";
		$result = mysqli_query($conn,$query);

		if ( !$result ){
			$response = array(); 
			$code = "avviso_false"; 
			$message = "Errore nel server, riprovare"; 
			array_push($response,array("code"=>$code,"message"=>$message));
			echo json_encode(array("server_response"=>$response)); 
		}
		else{
			$response = array(); 
			$code = "avviso_true"; 
			$message = "Corsa accettata, avviso il river!"; 
			array_push($response,array("code"=>$code,"message"=>$message));
			echo json_encode(array("server_response"=>$response));	
			$query = "INSERT INTO bitwheels (nome,bitwheel,data_ora) VALUES ('$usernamePasseggero','-$costoCorsa',NOW())";
			$result = mysqli_query($conn,$query); 
			$query = "INSERT INTO bitwheels (nome,bitwheel,data_ora) VALUES ('$usernameAutista','$costoCorsa',NOW())";
			$result = mysqli_query($conn,$query); 		
		}

	}
	else {
		$query = "UPDATE corsa SET esito='2' WHERE nomePasseggero='$usernamePasseggero' ";
		$result = mysqli_query($conn,$query);
	}


	mysqli_close($conn); 

}

?>