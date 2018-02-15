<?php
header('Content-Type: application/json');
require "init.php"; 



if ( $_SERVER["REQUEST_METHOD"] == "POST"){

	$email 		= trim(stripslashes(htmlspecialchars($_POST["email"]))); 
	$password 	= trim(stripslashes(htmlspecialchars($_POST["password"])));
	$driver 	= trim(stripslashes(htmlspecialchars($_POST['driver'])));
	$password = sha1($password);
	if ( $driver == "1" ){

		$query = "SELECT * FROM userinfo WHERE email = '".$email."' AND password = '".$password."' "; 

		$result = mysqli_query($conn, $query); 

		if ( mysqli_num_rows($result) > 0 ){
			$response = array(); 
			$code = "login_true"; 
			$row = mysqli_fetch_array($result); 
			$name = $row[1]; 
			$email = $row[2]; 
			$driver = $row[5];
			$targa = $row[8];
			if ( $driver == "1" ){
				if ( !$targa == "" ){
					$message = "Benvenuto: ".$name;
					array_push($response,array("code"=>$code,"message"=>$message)); 
					echo json_encode(array("server_response"=>$response)); 
				}
				else{
					$response = array(); 
					$code = "noDriverTarga"; 
					$message = "login error";
					array_push($response,array("code"=>$code,"message"=>$message)); 
					echo json_encode(array("server_response"=>$response));	
				}
			}
			else{
				$response = array(); 
				$code = "noDriver"; 
				$message = "login error";
				array_push($response,array("code"=>$code,"message"=>$message)); 
				echo json_encode(array("server_response"=>$response));	
			}
		}
		else{
			$response = array(); 
			$code = "login_false"; 
			$message = "login error";
			array_push($response,array("code"=>$code,"message"=>$message)); 
			echo json_encode(array("server_response"=>$response)); 
		}



		mysqli_close($conn); 
	}

	if ( $driver == "0" ){

		$query = "SELECT * FROM userinfo WHERE email = '".$email."' AND password = '".$password."' "; 

		$result = mysqli_query($conn, $query); 

		if ( mysqli_num_rows($result) > 0 ){
			$response = array(); 
			$code = "login_true"; 
			$row = mysqli_fetch_array($result); 
			$name = $row[1]; 
			$email = $row[2]; 
			$user = $row[4];
			if ( $user == "1" ){
				$message = "Benvenuto: ".$name;
				array_push($response,array("code"=>$code,"message"=>$message)); 
				echo json_encode(array("server_response"=>$response)); 
			}
			else{
				$response = array(); 
				$code = "noUser"; 
				$message = "login error";
				array_push($response,array("code"=>$code,"message"=>$message)); 
				echo json_encode(array("server_response"=>$response));	
			}
		}
		else{
			$response = array(); 
			$code = "login_false"; 
			$message = "login error";
			array_push($response,array("code"=>$code,"message"=>$message)); 
			echo json_encode(array("server_response"=>$response)); 
		}



		mysqli_close($conn); 

	}


}

?>