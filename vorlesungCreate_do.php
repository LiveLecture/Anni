<?php
	require_once("inc/check_dozent.php");

	require_once("Mapper/ErrorHandler.php");
	require_once("Mapper/VorlesungManager.php");

	$errorHandler = new ErrorHandler();
	$vorlesungManager = new VorlesungManager();

	if(!isset($_POST["name"]) || !isset($_POST["studiengang"]) || !isset($_POST["semester"])
		|| !isset($_POST["kursnummer"]) || !isset($_POST["ects"])
	) {
		$errorHandler->storeError("fehler", "Es wurden nicht alle POST Felder angegeben. Bitte wenden Sie sich an den Administrator.");
		header("Location: fehler.php");
		exit();
	}

	$name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
	$studiengang = htmlspecialchars($_POST["studiengang"], ENT_QUOTES, "UTF-8");
	$semester = htmlspecialchars($_POST["semester"], ENT_QUOTES, "UTF-8");
	$ects = htmlspecialchars($_POST["ects"], ENT_QUOTES, "UTF-8");
	$kursnummer = htmlspecialchars($_POST["kursnummer"], ENT_QUOTES, "UTF-8");

	if(!empty($name) && !empty($kursnummer) && !empty($studiengang) && !empty($semester) && !empty($ects)) {


		if(intval($kursnummer) == 0) {
			$errorHandler->storeError("vorlesungcreate", "Die Kursnummer muss eine Zahl sein!");
			header("Location: vorlesungCreate_form.php");
			exit();
		}
		if(intval($semester) == 0) {
			$errorHandler->storeError("vorlesungcreate", "Das Semester muss eine Zahl sein!");
			header("Location: vorlesungCreate_form.php");
			exit();
		}
		if(intval($ects) == 0) {
			$errorHandler->storeError("vorlesungcreate", "Die ECTS-Angabe muss eine Zahl sein!");
			header("Location: vorlesungCreate_form.php");
			exit();
		}
		
		$kursnummer = intval($kursnummer);
		if($vorlesungManager->findBykursnummer($kursnummer) != null) {
			$errorHandler->storeError("vorlesungcreate", "Die Kursnummer ist bereits vergeben!");
			header("Location: vorlesungCreate_form.php");
			exit();
		}

		$vorlesungsdaten = [
			"kursnummer"  => $kursnummer,
			"name"        => $name,
			"studiengang" => $studiengang,
			"semester"    => $semester,
			"ects"        => $ects,
			"id_dozent"   => $dozent->id_dozent
		];

		$vorlesung = new Vorlesung($vorlesungsdaten);
		$vorlesungManager->create($vorlesung);

		header('Location: vorlesungsUebersicht.php');
	} else {
		$errorHandler->storeError("vorlesungcreate", "Bitte alle Felder ausfüllen!");

		header('Location: vorlesungCreate_form.php');
	}
?>