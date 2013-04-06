<?php

class Database
{

	/**
	 * Create a database
	 * @param string $name
	 */
	function __construct($name) {
		$this -> name = $name;
		$this -> file = 'db/'.$this -> name.'.dat';
	}

	/**
	 * Initialize database for work and returns database status
	 * @return string
	 */
	function go() {
		if (file_exists($this -> file)) {
			return "Database '".$this -> name."' already exists.";
		}
		else {
			file_put_contents($this -> file, "");
			return "Database '".$this -> name."' successfully created.";
		}
	}

	/**
	 * Delete database
	 * @return string
	 */
	function rm() {
		if (file_exists($this -> file)) {
			unlink($this -> file);
			return "Database '".$this -> name."' successfully deleted.";
		}
		else {
			return "Database '".$this -> name."' doesn't exist.";
		}
	}

	/**
	 * Rewrite data
	 * @param  Array $data
	 */
	function rw($data) {
		file_put_contents($this -> file, json_encode($data));
	}

	/**
	 * Appends data to database
	 * @param array $data
	 */
	function add($data) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$wk = json_decode(file_get_contents($this -> file),true);
		}
		else {
			$wk = array();
		};
		$wk[] = $data;
		$this -> rw($wk);
	}

	function select($col) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$wk = json_decode(file_get_contents($this -> file),true);
			$result = array();
			$values = array();
			if ($col === array()) {
				foreach ($wk as $row) {
					foreach (array_keys($row) as $c) {
						$values[] = $row[$c];
					};
					$result[] = $values;
					$values = array();;
				}
			} else {
				foreach ($wk as $row) {
					foreach ($col as $c) {
						$values[] = $row[$c];
					};
					$result[] = $values;
					$values = array();
				}
			};
			return $result;
		} else {
			return ;
		}
	}

	/**
	 * Get the row where the value matches that of the key and return the value of the other key
	 * @param  array $ret
	 * @param  string $key
	 * @param  string $val
	 * @return array
	 */
	function where($ret,$key,$val) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$wk = json_decode(file_get_contents($this -> file),true);
			$result = array();
			$values = array();
			foreach ($wk as $rw) {
				if ($rw[$key] === $val) {
					foreach ($ret as $col) {
						$values[] = $rw[$col];
					};
					$result[] = $values;
					$values = array();
				};
			}
			return $result;
		}
		else {
			return ;
		};
	}

	/**
	 * Get the row where the value matches that of the key and return the value of the other key
	 * @param  string $ret
	 * @param  string $key
	 * @param  string $val
	 * @return array
	 */
	function get($ret,$key,$val) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$wk = json_decode(file_get_contents($this -> file),true);
			$result = array();
			foreach ($wk as $row) {
				if ($row[$key] === $val && $row[$ret]) {
					return $row[$ret];
				}
			}
			return $result;
		}
		else {
			return ;
		};
	}

	function exists($key,$val) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$wk = json_decode(file_get_contents($this -> file),true);
			$result = false;
			foreach ($wk as $row) {
				if ($row[$key] === $val) {
					$result = true;
				}
			}
			return $result;
		}
		else {
			return false;
		};
	}

}

?>