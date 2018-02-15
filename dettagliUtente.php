<?php
header('Content-Type: application/json');
require "init.php"; 

if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$username = trim(stripslashes(htmlspecialchars($_POST["username"]))); 

	$query = "SELECT Sum(bitwheel) as x FROM bitwheels WHERE nome = '".$username."' "; 

	$result = mysqli_query($conn, $query); 

	if ( mysqli_num_rows($result) > 0 ){
		$response = array(); 
		$code = "dettagli_true"; 
		$row = mysqli_fetch_array($result); 
		$ruotini = $row['x']; 
		$message = $ruotini;
		array_push($response,array("code"=>$code,"message"=>$message)); 
		echo json_encode(array("server_response"=>$response)); 
	}
	else{
		$response = array(); 
		$code = "dettagli_false"; 
		$message = "login error";
		array_push($response,array("code"=>$code,"message"=>$message)); 
		echo json_encode(array("server_response"=>$response)); 
	}
}


mysqli_close($conn); 

?>