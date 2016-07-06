<?php

	require_once("inc/check_admin.php");
	require_once("Mapper/DozentManager.php");
	require_once("Mapper/ErrorHandler.php");


	$id_dozent = (int)htmlspecialchars($_GET["id_dozent"], ENT_QUOTES, "UTF-8");

	$dozentManager = new DozentManager();
	$dozent = $dozentManager->findbyId($id_dozent);
	
	if($dozent==null) {
		$errorHandler = new ErrorHandler();
		$errorHandler->storeError("fehler", "Der zu löschende Dozent wurde nicht gefunden. Bitte wenden Sie sich an den Administrator!");
	}
	
	$dozentManager->delete($dozent);

	header('Location: dozentUebersicht.php');
?>