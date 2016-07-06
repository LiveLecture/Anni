<?php
	require_once("inc/check_admin.php");
	require_once("Mapper/ErrorHandler.php");
	require_once("Mapper/DozentManager.php");

	$errorHandler = new ErrorHandler();
	$error = $errorHandler->getError("dozentEdit");

	if(!isset($_GET["id_dozent"])) {
		header("Location: 404.php");
		exit();
	}

	$id_dozent = (int)htmlspecialchars($_GET["id_dozent"], ENT_QUOTES, "UTF-8");
	$dozentManager = new DozentManager();
	$dozent = $dozentManager->findbyId($id_dozent);

	if($dozent == null) {
		header("Location: 404.php");
		exit();
	}
?>

<!DOCTYPE html>
<html>

	<?php include("inc/head.php"); ?>

	<body>

		<?php include("inc/navbar_loggedin_admin.php"); ?>
		<?php include("inc/fehlermeldung.php") ?>

		<div class="container hauptbereich seite-fuellen panel">

			<h2 class="page-header">Edit <?php echo $dozent->vorname . " " . $dozent->nachname ?></h2>

			<div class="panel-body">

				<form class="form-horizontal" role="form" action="dozentEdit_do.php" method="post">
					<input type="hidden" name="id_dozent" value="<?php echo $dozent->id_dozent ?>">

					<div class="form-group">
						<label class="control-label col-sm-2" for="vorname">Vorname:</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" name="vorname" id="vorname"
								   placeholder="Vorname" value="<?php echo $dozent->vorname ?>">
						</div>
					</div>

					<div class="form-group">
						<label class="control-label col-sm-2" for="nachname">Nachname:</label>

						<div class="col-sm-10">
							<input type="text" class="form-control" name="nachname" id="nachname"
								   placeholder="Nachname" value="<?php echo $dozent->nachname ?>">
						</div>
					</div>

					<a href="dozentUebersicht.php" class="col-sm-offset-2 col-sm-2 btn btn-default">Zur&uuml;ck</a>

					<button type="submit" class=" col-sm-offset-6 col-sm-2 btn btn-default">Edit!</button>

				</form>
			</div>

		</div>

		<?php include("inc/footer.php") ?>
	</body>
</html>