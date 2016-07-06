<?php

	require_once("Mapper/DataManager.php");
	require_once("Mapper/Admin.php");

	class AdminManager extends DataManager {

		public function __construct($connection = null) {
			parent::__construct($connection);
		}

		public function __destruct() {
			parent::__destruct();
		}

		public function findByLogin($login, $password) {
			$admin = $this->findByLoginNotVerified($login);
			if(password_verify($password, $admin->hash)) {
				return $admin;
			} else {
				return null;
			}
		}

		public function findByLoginNotVerified($login) {
			try {
				$stmt = $this->pdo->prepare('SELECT * FROM Admin WHERE login = :login');
				$stmt->bindParam(':login', $login);
				$stmt->execute();
				$stmt->setFetchMode(PDO::FETCH_CLASS, 'Admin');

				$admin = $stmt->fetch();
				return $admin;
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}

		public function create(Admin $admin) {
			try {
				$stmt = $this->pdo->prepare('
				INSERT INTO Admin (login, vorname, nachname, hash)
				VALUES(:login, :vorname, :nachname, :hash)');

				$stmt->bindParam(':login', $admin->login);
				$stmt->bindParam(':vorname', $admin->vorname);
				$stmt->bindParam(':nachname', $admin->nachname);
				$stmt->bindParam(':hash', password_hash($admin->hash, PASSWORD_BCRYPT));
				$result = $stmt->execute();
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}
		}

		public function updatePasswort($id_admin, $passwort) {
			$hash = password_hash($passwort, PASSWORD_BCRYPT);

			try {
				$stmt = $this->pdo->prepare('
              UPDATE Admin
              SET hash = :hash
              WHERE id_admin = :id_admin
            ');
				$stmt->bindParam(':hash', $hash);
				$stmt->bindParam(':id_admin', $id_admin);
				$stmt->execute();
			} catch(PDOException $e) {
				echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
				die();
			}

			return $hash;
		}
	}

?>