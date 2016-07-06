<?php
	require_once("inc/check_dozent.php");

	require_once("Mapper/VorlesungManager.php");
	require_once("Mapper/ErrorHandler.php");

	$errorHandler = new ErrorHandler();

	if(!isset($_GET["kursnummer"])) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle GET Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}
	$kursnummer = (int)htmlspecialchars($_GET["kursnummer"], ENT_QUOTES, "UTF-8");

	$vorlesungManager = new VorlesungManager();
	$vorlesung = $vorlesungManager->findBykursnummer($kursnummer);

	if($vorlesung == null) {
		$errorHandler = new ErrorHandler();
		$errorHandler->storeError("fehler", "Die zu löschende Vorlesung wurde nicht gefunden. Bitte wenden Sie sich an den Administrator!");
	}

	if($dozent->id_dozent == $vorlesung->id_dozent) {
		$vorlesungManager->delete($vorlesung);
		header('Location: vorlesungsUebersicht.php');
	} else {
		$errorHandler->storeError("fehler", "Es wurden nicht alle GET Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}