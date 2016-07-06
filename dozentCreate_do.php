<?php
	require_once "inc/check_admin.php";

	require_once("Mapper/AdminManager.php");
	require_once("Mapper/DozentManager.php");
	require_once("Mapper/ErrorHandler.php");

	$errorHandler = new ErrorHandler();

	if(!isset($_POST["login"]) || !isset($_POST["vorname"]) || !isset($_POST["nachname"]) || !isset($_POST["hash"])) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle POST Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}

	$login = htmlspecialchars($_POST["login"], ENT_QUOTES, "UTF-8");
	$vorname = htmlspecialchars($_POST["vorname"], ENT_QUOTES, "UTF-8");
	$nachname = htmlspecialchars($_POST["nachname"], ENT_QUOTES, "UTF-8");
	$hash = htmlspecialchars($_POST["hash"], ENT_QUOTES, "UTF-8");

	if(!empty ($login) && !empty($vorname) && !empty($nachname) && !empty($hash)) {
		$adminManager = new AdminManager();
		$dozentManager = new DozentManager();
		
		if($dozentManager->findByLoginNotVerified($login) != null || $adminManager->findByLoginNotVerified($login) != null) {
			$errorHandler->storeError("dozentCreate", "Der Loginname ist bereits vergeben.");
			header("Location: dozentCreate_form.php");
			exit();
		}

		$dozentdaten = [
			"id_dozent" => $id_dozent,
			"login"     => $login,
			"vorname"   => $vorname,
			"nachname"  => $nachname,
			"hash"      => $hash,
		];

		$dozent = new Dozent($dozentdaten);

		$dozentManager->save($dozent);

		header('Location: dozentUebersicht.php');
	} else {
		$errorHandler->storeError("dozentCreate", "Bitte alle Felder ausfüllen!");
		header("Location: dozentCreate_form.php");
		exit();
	}
?>