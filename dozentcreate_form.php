<?php include("inc/admin_check.php"); ?>

<!DOCTYPE html>
<html>

<?php include("inc/head.php"); ?>

<body>

<?php include("inc/navbar_loggedin_dozent.php"); ?>

<div class="container hauptbereich seite-fuellen panel">

    <h2 class="page-header">Neuer Dozent</h2>

    <div class="panel-body">

        <form class="form-horizontal" role="form" action="dozentcreate_do.php" method="post">

            <div class="form-group">
                <label class="control-label col-sm-2" for="login">Login:</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="login" id="login" placeholder="Login">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="vorname">Vorname:</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="vorname" id="vorname"
                           placeholder="Vorname">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="nachname">Nachname:</label>

                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nachname" id="nachname"
                           placeholder="Nachname">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2" for="text">Passwort:</label>

                <div class="col-sm-10">
                    <input type="password" class="form-control" name="hash" id="hash" placeholder="Passwort">
                </div>
            </div>

            <a href="dozentuebersicht.php" class="col-sm-offset-2 col-sm-2 btn btn-default">Zur&uuml;ck</a>

            <button type="submit" class=" col-sm-offset-6 col-sm-2 btn btn-default">Hinzuf&uuml;gen</button>

        </form>
    </div>

</div>
</body>
</html>