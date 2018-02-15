<?php
header('Content-Type: application/json');
require "init.php";
 


if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$usernamePasseggero = trim(stripslashes(htmlspecialchars($_POST["usernamePasseggero"])));
	
	$query = "SELECT * FROM corsa WHERE nomePasseggero = '".$usernamePasseggero."' "; 

	$result = mysqli_query($conn, $query); 

	if ( mysqli_num_rows($result) > 0 ){
		$response = array(); 
		$row = mysqli_fetch_array($result); 
		$esito = $row[6]; 
		$esitoLetturaPasseggero = $row[7];
		if ( $esito == "1" ){
			//corsa accettata
			$code = "corsaAccettata_true"; 
			if ( $esitoLetturaPasseggero == 0 ){ 

				$indirizzoPasseggero = $row[1];
				$destinazione = $row[3]; 
				$nomePasseggero = $row[4];  
				$indirizzoAutista = $row[2];
				$nomeAutista = $row[5];
				$test = $row[6];
				$targa = $row[9];

				$message = "Indirizzo Driver: ".$indirizzoAutista."\nIndirizzo Rider: ".$indirizzoPasseggero."\nDestinazione: ".$destinazione."\nNome Driver: ".$nomeAutista."\nTarga: ".$targa;
				$indirizzoAutista = $indirizzoAutista;

				$query = "UPDATE corsa SET esitoLetturaPasseggero='1' WHERE nomePasseggero='$usernamePasseggero' ";
				$result = mysqli_query($conn,$query);

				$query = "UPDATE driver SET occupato='1' WHERE username='$nomeAutista' ";
				$result = mysqli_query($conn,$query);


				array_push($response,array("code"=>$code,"message"=>$message, "indirizzoPasseggero"=>$indirizzoPasseggero, "destinazione"=>$destinazione, "indirizzoAutista"=>$indirizzoAutista, "nomePasseggero"=>$nomePasseggero, "nomeAutista"=>$nomeAutista, "esito"=>$test,"targa"=>$targa)); 
				
				echo json_encode(array("server_response"=>$response)); 
			}
			else{

			}
		}
		if ( $esito == "2" ) {
			// corsa non accettata

			$code = "corsaRifiutata_true"; 
			if ( $esitoLetturaPasseggero == 0 ){

				$indirizzoPasseggero = $row[1];
				$destinazione = $row[3]; 
				$nomePasseggero = $row[4];  
				$indirizzoAutista = $row[2];
				$nomeAutista = $row[5];
				$test = $row[6];

				$message = "Indirizzo Driver: ".$indirizzoAutista."\nIndirizzo Rider: ".$indirizzoPasseggero."\nDestinazione: ".$destinazione."\nNome Driver: ".$nomeAutista;
				$indirizzoAutista = "indirizzoAutista".$indirizzoAutista;
				$query = "INSERT INTO riepilogo_corse (indirizzoPasseggero,indirizzoAutista,destinazione,nomePasseggero,nomeAutista,esito) VALUES ('$indirizzoPasseggero','$indirizzoAutista','$destinazione','$usernamePasseggero','$nomeAutista','$esito')";
				$result = mysqli_query($conn,$query); 
				$query =  "DELETE FROM corsa WHERE esito = '2' "; 
				$result = mysqli_query($conn,$query);
				array_push($response,array("code"=>$code,"message"=>$message, "indirizzoPasseggero"=>$indirizzoPasseggero, "destinazione"=>$destinazione, "indirizzoAutista"=>$indirizzoAutista, "nomePasseggero"=>$nomePasseggero, "nomeAutista"=>$nomeAutista, "esito"=>$test)); 
				
				echo json_encode(array("server_response"=>$response)); 
			}
		}
	}
}

mysqli_close($conn); 
?>