<?php
header('Content-Type: application/json');
require "init.php"; 



if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$email 		= trim(stripslashes(htmlspecialchars($_POST["email"]))); 
	$password 	= trim(stripslashes(htmlspecialchars($_POST["password"]))); 
	
	$query = "SELECT * FROM userinfo WHERE email = '".$email."'" ;
	$result = mysqli_query($conn,$query); 

	if (mysqli_num_rows ($result) > 0 ){
		$response = array(); 
		$query = "UPDATE userinfo SET password = '$password' WHERE email = '$email' "; 
		$esito = $conn->query($query); 
		$code = "pwd_ok"; 
		$message = "La password è stata modficata!"; 
		array_push($response,array("code"=>$code,"message"=>$message));
		echo json_encode(array("server_response"=>$response)); 
	}
	

	mysqli_close($conn); 

}


?>