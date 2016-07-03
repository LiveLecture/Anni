<?php
	include "../mapper/adminManager.php";

	$adminManager = new AdminManager();

	if($adminManager->findByLogin("omm", "hdm") == null) {
		$admin = new Admin([
			"login"    => "omm",
			"vorname"  => "Otto",
			"nachname" => "Karl",
			"hash"     => "hdm"
		]);
		$adminManager->create($admin);
	}

?>