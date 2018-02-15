<?php
header('Content-Type: application/json');
require "init.php"; 



if ( $_SERVER["REQUEST_METHOD"] == "POST"){
	
	$username 	= trim(stripslashes(htmlspecialchars($_POST["username"]))); 
	$ruolo 		= trim(stripslashes(htmlspecialchars($_POST["ruolo"])));

	if ( strcmp($ruolo,0) == 0 ){
		$query = "DELETE FROM driver WHERE username = '".$username."'" ;
		$esito = $conn->query($query); 
	}
	if ( strcmp($ruolo,1) == 0 ){
		$query = "DELETE FROM rider WHERE username = '".$username."'" ;
		$esito = $conn->query($query);	
	}



	mysqli_close($conn); 

}




?>