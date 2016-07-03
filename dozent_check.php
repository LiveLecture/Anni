<?php
	require_once("mapper/dozent.php");
	
    include("inc/session_check.php");

    if ($_SESSION ["login"]==1) {
        $dozent = $_SESSION ["dozent"];
    } else {
		header("Location: index.php");
	}


?>