<?php
header('Content-Type: application/json');
require "init.php"; 

$query = "SELECT * FROM driver WHERE servizio='1' "; 

$result = mysqli_query($conn, $query); 

$array = array(); $response = array(); 

if ( $result->num_rows > 0 ){
	while ( $riga = $result->fetch_assoc() ){

		$code = "login_true";
		$lat = trim(stripslashes(htmlspecialchars($riga['lat'])));
		$lng = trim(stripslashes(htmlspecialchars($riga['lng'])));
		$nome = trim(stripslashes(htmlspecialchars($riga['username'])));
		$occupato = trim(stripslashes(htmlspecialchars($riga['occupato'])));
		$targa = trim(stripslashes(htmlspecialchars($riga['targa'])));
		array_push($array, $riga);

	} 

		for($i=0; $i<count($array); $i++){
			$nome =  $array[$i]['username'];
			$query = "SELECT AVG(feedback) as feedback FROM riepilogo_corse WHERE nomeAutista = '{$nome}'"; 
			$result = mysqli_query($conn, $query); 
			if ( $result->num_rows > 0 )
				while ($riga = $result->fetch_assoc() ){
					if ( $riga['feedback'] > 0 ){
						$cnt = trim(stripslashes(htmlspecialchars($riga['feedback'])));; 
						
						array_push($response,array("code"=>$code,"lat"=>$array[$i]['lat'],"lng"=>$array[$i]['lng'], "username"=>$nome, "targa"=>$targa, "feedback"=>round($riga['feedback'],1),"occupato"=>$array[$i]['occupato']));
					}
					else
						array_push($response,array("code"=>$code,"lat"=>$array[$i]['lat'],"lng"=>$array[$i]['lng'], "username"=>$nome, "targa"=>$targa, "feedback"=>"0","occupato"=>$array[$i]['occupato']));
				}
			
		}

}

		echo json_encode(array("server_response"=>$response));

mysqli_close($conn); 

?>