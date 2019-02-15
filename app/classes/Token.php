<?php

class Token {
	public static function generate($tokenName) { 
		return Session::create($tokenName, base64_encode(openssl_random_pseudo_bytes(32)));
	}

	public static function check($tokenName, $token) {
		if (Session::exist($tokenName) && $token === Session::get($tokenName)) {
			Session::delete($tokenName);
			return true;
		}
		return false;
	}

	public static function generateKey() {
		$string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$keyLength = 30;
		$randstr = substr(str_shuffle($string), 0, $keyLength);
		return $randstr;
	}

	private function checkKey($uniqKey, $table, $field) {
		$results = DB::query("SELECT count(*) FROM {$table} WHERE {$field} = :key", ['key' => $uniqKey])->fetch();
		if($results['count(*)'] >= 1) {
			return true;
		} else {
			return false;
		}

	}

	public static function uniqKey($table, $field) {
		$key = self::generateKey();
		$checkKey = self::checkKey($key, $table, $field);
		while ($checkKey == true) {
			$key = self::generateKey();
			$checkKey = self::checkKey($key, $table, $field);
		}
		return $key;
	} 
}