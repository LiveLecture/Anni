<?php

require_once("dataManager.php");
require_once("admin.php");

class AdminManager extends DataManager
{
    protected $pdo;

    public function __construct($connection = null)
    {
        parent::__construct($connection);
    }

    public function __destruct()
    {
        parent::__destruct();
    }

    public function findByLogin($login, $password){
        try {
            $stmt = $this->pdo->prepare('SELECT * FROM Admin WHERE login = :login');
            $stmt->bindParam(':login', $login);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Admin');
            $admin = $stmt->fetch();

            $err = $stmt->errorInfo();
            if($err[2] !== null) {
                echo "File " . __FILE__ .", line: " + __LINE__ . "<br>";
                print_r($err);
                exit();
            }

            if (password_verify($password, $admin->hash)) {
                return $admin;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }
        return null;
    }

    public function create($admin) {
        try {
            $stmt = $this->pdo->prepare('
				INSERT INTO Admin (login, vorname, nachname, hash)
				VALUES(:login, :vorname, :nachname, :hash)');

            $stmt->bindParam(':login', $admin->login);
            $stmt->bindParam(':vorname', $admin->vorname);
            $stmt->bindParam(':nachname', $admin->nachname);
            $stmt->bindParam(':hash', password_hash($admin->hash, PASSWORD_BCRYPT));
            $result = $stmt->execute();

            $err = $stmt->errorInfo();
            if($err[2] !== null) {
                echo "File " . __FILE__ .", line: " . __LINE__ . "<br>";
                print_r($err);
                exit();
            }

        } catch(PDOException $e) {
            echo("Fehler! Bitten wenden Sie sich an den Administrator...<br>" . $e->getMessage() . "<br>");
            die();
        }

        return $result;
    }
}
?>