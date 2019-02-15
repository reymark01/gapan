<?php

class DB {	
	public static function connect() {
		$pdo = new PDO('mysql:host=127.0.0.1;dbname=thesis', 'root', 'root');
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		return $pdo;
	}

	public static function query($sql, $params = array(), $hasInts = false, $ints = array()) {
		$stmt = self::connect()->prepare($sql);
		if ($hasInts == true) {
			foreach($params as $param => $val) {
				$stmt->bindValue($param, $val);
			}
			foreach($ints as $int => $intval) {
				$stmt->bindValue($int, $intval, PDO::PARAM_INT);
			}
			$stmt->execute();
		} else {
			$stmt->execute($params);
		}
		return $stmt;
	}

}