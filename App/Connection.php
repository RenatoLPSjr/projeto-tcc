<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=localhost;dbname=bd_andre",
				"root",
				"" 
			);

			
			return $conn;

		} catch (\PDOException $e) {
			$e->errorInfo;
		}
	}
}

?>