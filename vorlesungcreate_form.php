<?php 
	require_once("inc/dozent_check.php");
	require_once("mapper/errorHandler.php");
	
	$errorHandler = new ErrorHandler();
	$error = $errorHandler->getError("vorlesungcreate");
?>

<!DOCTYPE html>
<html>

	<?php include("inc/head.php"); ?>

	<body>

		<?php include("inc/navbar_loggedin_dozent.php"); ?>

		<?php include("inc/fehlermeldung.php"); ?>

		<div class="container panel hauptbereich">

			<h2 class="panel-heading">Neue Vorlesung</h2>

			<form class="panel-body form-horizontal" role="form" action="vorlesungcreate_do.php" method="post">

				<div class="form-group">
					<label class="control-label col-sm-2" for="name">Name:<br>(maximal 50 Zeichen)</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="name" id="name"
							   placeholder="bsp.: Web-Engineering">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="kursnummer">Kursnummer:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="kursnummer" id="kursnummer"
							   placeholder="bsp.: 123456">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="studiengang">Studiengang:</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" name="studiengang" id="studiengang"
							   placeholder="bsp.: OM7">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="semester">Semester:</label>
					<div class="col-sm-10">
						<input rows="3" class="form-control" name="semester" id="semester" placeholder="bsp.: 3">
					</div>
				</div>

				<div class="form-group">
					<label class="control-label col-sm-2" for="ects">ECTS:</label>
					<div class="col-sm-10">
						<input rows="3" class="form-control" name="ects" id="ects" placeholder="bsp.: 10">
					</div>
				</div>

				<a href="vorlesungsuebersicht.php" class="col-sm-offset-2 col-sm-2 btn btn-default">Zur&uuml;ck</a>
				<button type="submit" class=" col-sm-offset-6 col-sm-2 btn btn-default">Hinzuf&uuml;gen</button>
			</form>

		</div>
	</body>
</html>