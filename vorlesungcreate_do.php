<?php
	require_once("inc/dozent_check.php");

	require_once("mapper/vorlesungManager.php");

	require_once("mapper/errorHandler.php");

	if(!isset($_POST["name"]) || !isset($_POST["studiengang"]) || !isset($_POST["semester"])
		|| !isset($_POST["kursnummer"]) || !isset($_POST["ects"])
	) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle POST Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}

	$kursnummer = htmlspecialchars($_POST["kursnummer"], ENT_QUOTES, "UTF-8");
	$name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
	$studiengang = htmlspecialchars($_POST["studiengang"], ENT_QUOTES, "UTF-8");
	$semester = htmlspecialchars($_POST["semester"], ENT_QUOTES, "UTF-8");
	$ects = htmlspecialchars($_POST["ects"], ENT_QUOTES, "UTF-8");


	if(!empty($name) && !empty($kursnummer) && !empty($studiengang) && !empty($semester) && !empty($ects)) {
		$vorlesungsdaten = [
			"kursnummer"  => $kursnummer,
			"name"        => $name,
			"studiengang" => $studiengang,
			"semester"    => $semester,
			"ects"        => $ects,
			"id_dozent"   => $dozent->id_dozent
		];

		$vorlesung = new Vorlesung($vorlesungsdaten);

		$vorlesungManager = new VorlesungManager();
		$vorlesungManager->create($vorlesung, $dozent);

		header('Location: vorlesungsverzeichnis.php');
	} else {
		$errorHandler = new ErrorHandler();
		$errorHandler->storeError("vorlesungcreate", "Bitte alle Felder ausfüllen!");

		header('Location: vorlesungcreate_form.php');
	}


