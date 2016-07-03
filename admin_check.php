<?php
	require_once("mapper/admin.php");
	
    include("session_check.php");

    if ($_SESSION ["login"]==2) {
		$admin = $_SESSION ["admin"];
    } else {
		header("Location: index.php");
	}

?>