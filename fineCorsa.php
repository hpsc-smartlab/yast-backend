<?php
header('Content-Type: application/json');
require "init.php"; 


if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$usernamePasseggero = trim(stripslashes(htmlspecialchars($_POST["usernamePasseggero"])));
	$feedback = trim(stripslashes(htmlspecialchars($_POST['feedback'])));

	$query = "SELECT * FROM corsa WHERE nomePasseggero = '".$usernamePasseggero."' "; 

	$result = mysqli_query($conn, $query); 

	if ( mysqli_num_rows($result) > 0 ){
		$response = array(); 
		$row = mysqli_fetch_array($result); 
		$esito = $row[6]; 
		$esitoLetturaPasseggero = $row[7];

		if ( $esito == "1" ){

			$code = "feedback_true"; 
			$message = "Hai votato"; 

			$indirizzoPasseggero = $row[1];
			$destinazione = $row[3]; 
			$nomePasseggero = $row[4];  
			$indirizzoAutista = $row[2];
			$nomeAutista = $row[5];
			$test = $row[6];
			$bitwheels = $row[8];

			$indirizzoAutista = addslashes($indirizzoAutista); 
			$indirizzoPasseggero = addslashes($indirizzoPasseggero);
			$destinazione = addslashes($destinazione);

			$query = "INSERT INTO riepilogo_corse (indirizzoPasseggero,indirizzoAutista,destinazione,nomePasseggero,nomeAutista,esito,feedback,bitwheels,data) VALUES ('$indirizzoPasseggero','$indirizzoAutista','$destinazione','$usernamePasseggero','$nomeAutista','$esito','$feedback','$bitwheels',NOW())";
			$result = mysqli_query($conn,$query); 
			$query =  "DELETE FROM corsa WHERE esito = '1' "; 
			$result = mysqli_query($conn,$query);

			$query = "UPDATE driver SET occupato='0' WHERE username='$nomeAutista' ";
			$result = mysqli_query($conn,$query);

			array_push($response,array("code"=>$code,"message"=>$message, "nomeAutista"=>$nomeAutista, "feedback"=>$feedback)); 
			echo json_encode(array("server_response"=>$response)); 

		}
	}
}

?>