<?php
	require_once("inc/check_dozent.php");

	require_once("Mapper/VorlesungManager.php");
	require_once("Mapper/ErrorHandler.php");

	if(!isset($_GET["kursnummer"])) {
		header("Location: 404.php");
		exit();
	}

	$errorHandler = new ErrorHandler();
	$error = $errorHandler->getError("vorlesungedit");

	$kursnummer = (int)htmlspecialchars($_GET["kursnummer"], ENT_QUOTES, "UTF-8");
	$vorlesungManager = new VorlesungManager();
	$vorlesung = $vorlesungManager->findBykursnummer($kursnummer);

	if($vorlesung == null) {
		header("Location: 404.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>
	<?php include("inc/head.php"); ?>
	<body>
		<?php include("inc/navbar_loggedin_dozent.php"); ?>

		<?php include("inc/fehlermeldung.php") ?>

		<div class="container panel hauptbereich seite-fuellen">
			<h1 class="panel-heading">Edit <?php echo($vorlesung->name) ?></h1>
			<div class="panel-body">
				<form class="form-horizontal" action='vorlesungEdit_do.php' method='post'>
					<input type='hidden' name='kursnummer' class="form-control"
						   value='<?php echo($vorlesung->kursnummer) ?>'/>
					<div class="form-group">
						<label class="control-label col-sm-2" for="name">Name:</label>
						<div class="col-sm-10">
							<input type='text' name='name' class="form-control"
								   value='<?php echo($vorlesung->name) ?>'/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="studiengang">Studiengang:</label>
						<div class="col-sm-10">
							<input type='text' name='studiengang' class="form-control"
								   value='<?php echo($vorlesung->studiengang) ?>'/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="semester">Semester):</label>
						<div class="col-sm-10">
							<input type='text' name='semester' class="form-control"
								   value='<?php echo($vorlesung->semester) ?>'/>
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-2" for="ects">ECTS:</label>
						<div class="col-sm-10">
							<input type='text' name='ects' class="form-control"
								   value='<?php echo($vorlesung->ects) ?>'/>
						</div>
					</div>
					<div class="margin-top-5px">
						<a href="vorlesungsUebersicht.php" class="col-sm-offset-2 col-sm-2 btn btn-default">Zurück</a>
						<input type='submit' class="col-sm-offset-6 col-sm-2 btn btn-default" value='Edit!'/>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>