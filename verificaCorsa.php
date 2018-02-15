<?php
header('Content-Type: application/json');
require "init.php"; 

if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$username = trim(stripslashes(htmlspecialchars($_POST["usernameAutista"]))); 
	
	$query = "SELECT * FROM corsa WHERE nomeAutista = '".$username."' AND esito = '0'"; 
	$result = mysqli_query($conn, $query); 
	if ( mysqli_num_rows($result) > 0 ){
		$response = array(); 
		$code = "corsa_true"; 
		$row = mysqli_fetch_array($result); 
		$indirizzoPasseggero = $row[1];
		$destinazione = $row[3]; 
		$nomePasseggero = $row[4];  
		$indirizzoAutista = $row[2];
		$costoCorsa = $row[8]; 
		$message = "Indirizzo Rider: ".$indirizzoPasseggero."\nDestinazione: ".$destinazione."\nNome Rider: ".$nomePasseggero."\nGuadagno in BitWheels: ".$costoCorsa;
		array_push($response,array("code"=>$code,"message"=>$message, "indirizzoPasseggero"=>$indirizzoPasseggero, "destinazione"=>$destinazione, "indirizzoAutista"=>$indirizzoAutista, "nomePasseggero"=>$nomePasseggero, "costoCorsa"=>$costoCorsa)); 
		echo json_encode(array("server_response"=>$response)); 
	}

	if ( mysqli_num_rows($result) == 0 ){
		 $query = "SELECT * FROM corsa WHERE nomeAutista = '".$username."' "; 
		 $result = mysqli_query($conn, $query);
		 if ( mysqli_num_rows($result) == 0 ){
			$response = array(); 
			$code = "corsa"; 
			$message = "ok";
			array_push($response,array("code"=>$code,"message"=>$message)); 
			echo json_encode(array("server_response"=>$response));
		 }
	}

	mysqli_close($conn); 
}

?>