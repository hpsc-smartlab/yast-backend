<?php
header('Content-Type: application/json');
require "init.php"; 

$query = "SELECT * FROM rider WHERE servizio='1'"; 

$result = mysqli_query($conn, $query); 

$array = array(); $response = array(); 

if ( $result->num_rows > 0 ){
	while ( $riga = $result->fetch_assoc() ){
		
		$code = "login_true";
		$lat = trim(stripslashes(htmlspecialchars($riga['lat'])));
		$lng = trim(stripslashes(htmlspecialchars($riga['lng'])));
		$nome = trim(stripslashes(htmlspecialchars($riga['username'])));
		$ruotini = trim(stripslashes(htmlspecialchars($riga['ruotini'])));
		array_push($response,array("code"=>$code,"lat"=>$lat,"lng"=>$lng, "username"=>$nome));
	} 
		echo json_encode(array("server_response"=>$response),JSON_PRETTY_PRINT);
}




mysqli_close($conn); 

?>