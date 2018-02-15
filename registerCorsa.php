<?php
header('Content-Type: application/json');
require "init.php"; 

if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$indirizzoPasseggero = trim(stripslashes(htmlspecialchars($_POST["indirizzoPasseggero"]))); 
	$indirizzoAutista 	 = trim(stripslashes(htmlspecialchars($_POST["indirizzoAutista"]))); 
	$destinazione 		 = trim(stripslashes(htmlspecialchars($_POST["destinazione"]))); 
	$usernamePasseggero  = trim(stripslashes(htmlspecialchars($_POST["usernamePasseggero"]))); 
	$usernameAutista	 = trim(stripslashes(htmlspecialchars($_POST["usernameAutista"])));
	$costoCorsa 		 = trim(stripslashes(htmlspecialchars($_POST["costoCorsa"])));
	$targa 				 = trim(stripslashes(htmlspecialchars($_POST['targa'])));

	if (isset($indirizzoPasseggero,$indirizzoAutista,$destinazione,$usernamePasseggero,$usernameAutista)  ){
		if ( !empty($indirizzoPasseggero) && (!empty($indirizzoAutista)) && (!empty($destinazione)) && (!empty($usernamePasseggero)) && (!empty($usernameAutista)) ){

			$query = "SELECT nomePasseggero FROM corsa WHERE nomePasseggero = '".$usernamePasseggero."' AND esito = '0' " ;
			$result = mysqli_query($conn,$query); 

			$destinazione = addslashes($destinazione);
			$indirizzoAutista = addslashes($indirizzoAutista); 
			$indirizzoPasseggero = addslashes($indirizzoPasseggero);

			if (mysqli_num_rows ($result) > 0 ){
				$response = array(); 
				$code = "reg_false"; 
				$message = "Hai gia richisto una corsa!"; 
				array_push($response,array("code"=>$code,"message"=>$message));
				echo json_encode(array("server_response"=>$response)); 
			}
			else{
			$query = "INSERT INTO corsa (indirizzoPasseggero,indirizzoAutista,destinazione,nomePasseggero,nomeAutista,esito,costo,targa) VALUES ('$indirizzoPasseggero','$indirizzoAutista','$destinazione','$usernamePasseggero','$usernameAutista','0',$costoCorsa,'$targa')";
			$result = mysqli_query($conn,$query); 

				if ( !$result ){
					$response = array(); 
					$code = "reg_false"; 
					$message = $conn->error; 
					array_push($response,array("code"=>$code,"message"=>$message));
					echo json_encode(array("server_response"=>$response)); 
				}
				else{
					$response = array(); 
					$code = "reg_true"; 
					$message = "Invia richiesta corsa effettuata"; 
					array_push($response,array("code"=>$code,"message"=>$message, "indirizzoPasseggero"=>$indirizzoPasseggero,"indirizzoAutista"=>$indirizzoAutista,"destinazione"=>$destinazione,"usernamePasseggero"=>$usernamePasseggero,"usernameAutista"=>$usernameAutista));
					echo json_encode(array("server_response"=>$response));	
				}


			}
			mysqli_close($conn); 
		}
	}

}



?>