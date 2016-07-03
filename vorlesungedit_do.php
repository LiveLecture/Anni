<?php
	require_once("inc/dozent_check.php");

	require_once("mapper/vorlesungManager.php");
	require_once("mapper/errorHandler.php");
	
	$errorHandler = new ErrorHandler();

	if(!isset($_POST["name"]) || !isset($_POST["studiengang"]) || !isset($_POST["semester"])
		|| !isset($_POST["kursnummer"]) || !isset($_POST["ects"])) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle POST Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}
	
	$kursnummer = htmlspecialchars($_POST["kursnummer"], ENT_QUOTES, "UTF-8");
	$name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
	$studiengang = htmlspecialchars($_POST["studiengang"], ENT_QUOTES, "UTF-8");
	$semester = htmlspecialchars($_POST["semester"], ENT_QUOTES, "UTF-8");
	$ects = htmlspecialchars($_POST["ects"], ENT_QUOTES, "UTF-8");

	$vorlesungManager = new VorlesungManager();
	$vorlesung = $vorlesungManager->findBykursnummer($kursnummer);

	if($dozent->id_dozent !== $vorlesung->id_dozent) {
		$errorHandler->storeError("fehler", "Sie sind nicht berechtigt diese Vorlesung zu bearbeiten.");
		header("Location: fehler.php");
		exit();
	}
	
	if(!empty($kursnummer) && !empty($name) && !empty($studiengang) && !empty($semester) && !empty($ects)) {
		$vorlesung->name = $name;
		$vorlesung->studiengang = $studiengang;
		$vorlesung->semester = $semester;
		$vorlesung->ects = $ects;
		$vorlesungManager->save($vorlesung);

		header('Location: vorlesungsverzeichnis.php');
	} else {
		$errorHandler = new ErrorHandler();
		$errorHandler->storeError("vorlesungedit", "Error: Bitte alle Felder ausfüllen!");
		header("Location: vorlesungedit_form?kursnummer=".$kursnummer);
	}

