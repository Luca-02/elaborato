<?php
	session_start();
		//elimina le variabili di sessione impostate
		$_SESSION = array();
		// elimina la sessione
		session_destroy();
		header("Location: ./mainPage.php");
?>
