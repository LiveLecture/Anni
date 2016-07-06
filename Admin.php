<?php

	class Admin {

		public $id_admin;
		public $login;
		public $vorname;
		public $nachname;
		public $hash;

		function __construct($data = null) {
			if(is_array($data)) {
				$this->login = $data ['login'];
				$this->vorname = $data['vorname'];
				$this->nachname = $data['nachname'];
				$this->hash = $data['hash'];
			}
		}
	}

?>

