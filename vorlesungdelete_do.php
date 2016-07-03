<?php
	require_once("inc/dozent_check.php");

	require_once("mapper/vorlesungManager.php");
	require_once("mapper/errorHandler.php");
	
	$errorHandler = new ErrorHandler();

	if(!isset($_GET["kursnummer"])) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle GET Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}
	$kursnummer = (int)htmlspecialchars($_GET["kursnummer"], ENT_QUOTES, "UTF-8");

	$vorlesungManager = new VorlesungManager();
	$vorlesung = $vorlesungManager->findBykursnummer($kursnummer);

	if($dozent->id_dozent == $vorlesung->id_dozent) {
		$vorlesungManager->delete($vorlesung);
		header('Location: vorlesungsverzeichnis.php');
	} else {
		$errorHandler->storeError("fehler", "Es wurden nicht alle GET Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}



