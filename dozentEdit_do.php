<?php
	require_once "inc/check_admin.php";

	require_once("Mapper/AdminManager.php");
	require_once("Mapper/DozentManager.php");
	require_once("Mapper/ErrorHandler.php");

	$errorHandler = new ErrorHandler();

	if(!isset($_POST["vorname"]) || !isset($_POST["nachname"]) || !isset($_POST["id_dozent"])) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle POST Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}

	$vorname = htmlspecialchars($_POST["vorname"], ENT_QUOTES, "UTF-8");
	$nachname = htmlspecialchars($_POST["nachname"], ENT_QUOTES, "UTF-8");
	$id_dozent = htmlspecialchars($_POST["id_dozent"], ENT_QUOTES, "UTF-8");

	if(!empty($vorname) && !empty($nachname) && !empty($id_dozent)) {
		$adminManager = new AdminManager();
		$dozentManager = new DozentManager();

		$dozent = $dozentManager->findbyId($id_dozent);
		if($dozent == null) {
			$errorHandler->storeError("fehler", "Der zu bearbeitende Dozent wurde nicht gefunden. Bitte wenden Sie sich an den Administrator.");
			header("Location: fehler.php");
			exit();
		}

		$dozent->vorname = $vorname;
		$dozent->nachname = $nachname;

		$dozentManager->save($dozent);

		header('Location: dozentUebersicht.php');
	} else {
		$errorHandler->storeError("dozentCreate", "Bitte alle Felder ausfüllen!");
		header("Location: dozentCreate_form.php");
		exit();
	}
?>