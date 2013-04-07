<?php

class Fllat
{

	/**
	 * Create a database
	 * @param string $name
	 */
	function __construct($name, $path = "db") {
		$this -> name = $name;
		$this -> path = $path;
		$this -> file = realpath($path . "/" . $this -> name . '.dat');
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
			$db = json_decode(file_get_contents($this -> file),true);
		}
		else {
			$db = array();
		};
		$db[] = $data;
		$this -> rw($db);
	}

	/**
	 * Get the row where the value matches that of the key and return the value of the other key
	 * @param  string $col
	 * @param  string $key
	 * @param  string $val
	 * @return array
	 */
	function get($col,$key,$val) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode(file_get_contents($this -> file),true);
			foreach ($db as $row) {
				if ($row[$key] === $val && $row[$col]) {
					return $row[$col];
					break;
				}
			}
		}
		else {
			return ;
		}
	}

	/**
	 * Checks whether the given key/value pair exists
	 * @param  string  $key the key
	 * @param  string  $val the value
	 * @return boolean      whether the pair exists
	 */
	function exists($key,$val) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode(file_get_contents($this -> file),true);
			$result = false;
			foreach ($db as $row) {
				if ($row[$key] === $val) {
					$result = true;
				}
			}
			return $result;
		}
		else {
			return false;
		}
	}

	/**
	 * Get a set of columns for all rows
	 * @param  array $cols the list of columns to get, empty for all
	 * @return array
	 */
	function select($cols) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode(file_get_contents($this -> file),true);
			$result = array();
			$values = array();
			if ($cols === array()) {
				foreach ($db as $row) {
					foreach (array_keys($row) as $c) {
						$values[$c] = $row[$c];
					};
					$result[] = $values;
					$values = array();;
				}
			} else {
				foreach ($db as $row) {
					foreach ((array) $cols as $c) {
						$values[$c] = $row[$c];
					};
					$result[] = $values;
					$values = array();
				}
			}
			return $result;
		} else {
			return ;
		}
	}

	/**
	 * Get the row where the value matches that of the key and return the value of the other key
	 * @param  array  $cols
	 * @param  string $key
	 * @param  string $val
	 * @return array
	 */
	function where($cols,$key,$val) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode(file_get_contents($this -> file),true);
			$result = array();
			$values = array();
			if ($cols === array()) {
				foreach ($db as $row) {
					if ($row[$key] === $val) {
						foreach (array_keys($row) as $c) {
							$values[$c] = $row[$c];
						};
						$result[] = $values;
						$values = array();
					}
				}
			} else {
				foreach ($db as $row) {
					if ($row[$key] === $val) {
						foreach ((array) $cols as $c) {
							$values[$c] = $row[$c];
						};
						$result[] = $values;
						$values = array();
					};
				}
			}
			return $result;
		}
		else {
			return ;
		}
	}

	/**
	 * Get columns from rows in which the key's value is part of the inputted array of values
	 * @param  array  $cols  the columns to return
	 * @param  string $key   the column to look for the value
	 * @param  array  $val   an array of values to be accepted
	 * @return array
	 */
	function in($cols, $key, $val) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode(file_get_contents($this -> file),true);
			$result = array();
			$values = array();
			if ($cols === array()) {
				foreach ($db as $row) {
					if (in_array($row[$key],$val)) {
						foreach (array_keys($row) as $c) {
							$values[$c] = $row[$c];
						};
						$result[] = $values;
						$values = array();
					}
				}
			} else {
				foreach ($db as $row) {
					if (in_array($row[$key],$val)) {
						foreach ((array) $cols as $c) {
							$values[$c] = $row[$c];
						};
						$result[] = $values;
						$values = array();
					};
				}
			}
			return $result;
		}
		else {
			return ;
		}
	}

	function like($cols,$key,$regex) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode(file_get_contents($this -> file),true);
			$result = array();
			$values = array();
			if ($cols === array()) {
				foreach ($db as $row) {
					if (preg_match($regex, $row[$key])) {
						foreach (array_keys($row) as $c) {
							$values[$c] = $row[$c];
						};
						$result[] = $values;
						$values = array();
					}
				}
			} else {
				foreach ($db as $row) {
					if (preg_match($regex, $row[$key])) {
						foreach ((array) $cols as $c) {
							$values[$c] = $row[$c];
						};
						$result[] = $values;
						$values = array();
					};
				}
			}
			return $result;
		}
		else {
			return ;
		}
	}

}

?>