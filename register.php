<?php
header('Content-Type: application/json');
require "init.php"; 



if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$name 		= trim(stripslashes(htmlspecialchars($_POST["name"]))); 
	$email 		= trim(stripslashes(htmlspecialchars($_POST["email"]))); 
	$password 	= trim(stripslashes(htmlspecialchars($_POST["password"]))); 

	$query = "SELECT * FROM userinfo WHERE email = '".$email."'" ;
	$result = mysqli_query($conn,$query); 

	if (mysqli_num_rows ($result) > 0 ){
		$response = array(); 
		$code = "reg_false"; 
		$message = "Utente esistente, riprovare"; 
		array_push($response,array("code"=>$code,"message"=>$message));
		echo json_encode(array("server_response"=>$response)); 
	}
	else{
		
		$response = array(); 
		$code = "reg_true"; 
		$message = "Email inviata :)"; 
		array_push($response,array("code"=>$code,"message"=>$message));
		echo json_encode(array("server_response"=>$response));	
		$headers = "From: yasts@altervista.org";
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	    $encodeEmail = base64_encode($email);
		$link = "www.yasts.altervista.org/new_user.php?a={$encodeEmail}";
		$messaggio = "Per continuare la registrazione, clicca sul seguente link {$link}"; 
		mail($email, "Registrazione Yasts", $messaggio,$headers); 
	}

	mysqli_close($conn); 

}



?>