<?php

class Validate {
	private $_passed = false,
			$_errors = array();
	public function check($type, $items = array()) {
		foreach ($items as $item => $rules) {
			foreach ($rules as $rule => $rulevalue) {
				if ($item == 'file') {
					if (!empty($_FILES[$item]['name'])) {
						$value = $_FILES[$item];
					} else {
						$value = '';
					}
				} elseif ($item == 'option' || $item == 'select') {
					if (isset($type[$item])) {
						$value = $type[$item];
					} else {
						$value = '';
					}
				} else {
					$value = $type[$item];
				}
				if($rule == 'required' && empty($value)) {
						$this->addError([$item => 'is required']);
				} else if(!empty($value)) {
					switch($rule) {
						case 'min' :
							if (strlen($value) < $rulevalue) {
								$this->addError([$item => "must be greater than {$rulevalue} characters"]);
							}
						break;
						case 'max' :
							if (strlen($value) > $rulevalue) {
								$this->addError([$item => "must be less than {$rulevalue} characters"]);
							}
						break;
						case 'matches' :
							if ($value != $type[$rulevalue]) {
								$this->addError([$rulevalue => 'not match']);
							}
						break;
						case 'pregmatch' :
							if ($rulevalue == 'a') {
								if (!preg_match("/^[a-zA-Z ]*$/", $value)) {
									$this->addError([$item => 'is invalid']);
								}
							} elseif ($rulevalue == 'b') {
								if (!preg_match("/^[a-z0-9_-]*$/", $value)) {
									$this->addError([$item => 'is invalid']);
								}
							} elseif ($rulevalue == 'email') {
								if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
									$this->addError([$item => 'is invalid']);
								}
							} elseif ($rulevalue == 'c') {
								if (!preg_match("/^[0-9-]*$/", $value)) {
									$this->addError([$item => 'is invalid']);
								}
							} elseif ($rulevalue == 'd') {
								if (!preg_match("/^[a-zA-Z '!@&$0-9_-]*$/", $value)) {
									$this->addError([$item => 'is Invalid']);
								}
							} elseif ($rulevalue == 'e') {
								if (!preg_match("/^[0-9,]*$/", $value)) {
									$this->addError([$item => 'is invalid']);
								}
							} elseif ($rulevalue == 'f') {
								if (!preg_match("/^[0-9.]*$/", $value)) {
									$this->addError([$item => 'is invalid']);
								}
							}
						break;
						case 'unique' :
							$sql = "SELECT count(*) FROM users WHERE username = :username";
							$result = DB::query($sql, ['username' => $value])->fetch();
							if ($result['count(*)'] >= 1) {
								$this->addError([$item => 'already taken']);
							} else {
								$sql2 = "SELECT count(*) FROM stores WHERE b_username = :username";
								$result2 = DB::query($sql2, ['username' => $value])->fetch();
								if ($result2['count(*)'] >= 1) {
									$this->addError([$item => 'already taken']);
								}
							}
						break;
						case 'ftype' :
							$fileName = $value['name'];
							$fileext = explode(".", $fileName);
							$fileactualext = strtolower(end($fileext));
							if (!in_array($fileactualext, $rulevalue)) {
								$this->addError([$item => 'file type invalid']);
							}
						break;
						case 'mul-ftype' :
							foreach ($value['name'] as $qwe) {
								$fileext = explode(".", $qwe);
								$fileactualext = strtolower(end($fileext));
								if (!in_array($fileactualext, $rulevalue)) {
									$this->addError([$item => 'file type invalid']);
								}
							}
						break;
					}
				}
			}
		}
		if(empty($this->_errors)) {
			$this->_passed = true;
		}

		return $this;
	}

	private function addError($error = array()) {
		$this->_errors[] = $error;
	}

	public function errors() {
		return $this->_errors;
	}

	public function passed() {
		return $this->_passed;
	}
	public static function arrageArray($file) {
		$file_array = array();
		$file_count = count($file['name']);
		$file_keys = array_keys($file);
		for ($i=0; $i<$file_count; $i++) {
			foreach($file_keys as $key) {
				$file_array[$i][$key] = $file[$key][$i];
			}
		}
		return $file_array;
	}
	public static function formatDate($timestamp) {
		$datetime = explode(' ', $timestamp);
		$date = explode('-',$datetime[0]);
		$time = explode(':',$datetime[1]);
		switch ($date[1]) {
			case 1:
				$month = 'Jan';
			break;
			case 2:
				$month = 'Feb';
			break;
			case 3:
				$month = 'Mar';
			break;
			case 4:
				$month = 'Apr';
			break;
			case 5:
				$month = 'May';
			break;
			case 6:
				$month = 'Jun';
			break;
			case 7:
				$month = 'Jul';
			break;
			case 8:
				$month = 'Aug';
			break;
			case 9:
				$month = 'Sep';
			break;
			case 10:
				$month = 'Oct';
			break;
			case 11:
				$month = 'Nov';
			break;
			case 12:
				$month = 'Dec';
			break;
		}
		if ($time[0] <= 12) {
			$newtime = $time[0].':'.$time[1].' AM';
		} else {
			switch ($time[0]) {
				case 13:
					$newtime = '1:'.$time[1].' PM';
				break;
				case 14:
					$newtime = '2:'.$time[1].' PM';
				break;
				case 15:
					$newtime = '3:'.$time[1].' PM';
				break;
				case 16:
					$newtime = '4:'.$time[1].' PM';
				break;
				case 17:
					$newtime = '5:'.$time[1].' PM';
				break;
				case 18:
					$newtime = '6:'.$time[1].' PM';
				break;
				case 19:
					$newtime = '7:'.$time[1].' PM';
				break;
				case 20:
					$newtime = '8:'.$time[1].' PM';
				break;
				case 21:
					$newtime = '9:'.$time[1].' PM';
				break;
				case 22:
					$newtime = '10:'.$time[1].' PM';
				break;
				case 23:
					$newtime = '11:'.$time[1].' PM';
				break;
				case 24:
					$newtime = '12:'.$time[1].' PM';
				break;


			}
		}
		return $month.' '.$date[2].', '.$date[0].' at '.$newtime;
	}
}