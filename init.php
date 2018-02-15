<?php
	
	$host 			= "localhost"; 
	$user 			= "root"; 
	$password_db 	= "osiride";
	$db_name 		= "my_yasts";

	$conn = new mysqli($host,$user,$password_db,$db_name);

	if ( !$conn )
		die ( "Errore nel fase di connessione al db!".$conn->connect_error);



?>
