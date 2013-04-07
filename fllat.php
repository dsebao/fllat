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
		$this -> go($path . "/" . $this -> name . '.dat');
	}

	/**
	 * Initialize database for work
	 * @param  string $file  relative path of database
	 * @return string        existence status of database
	 */
	function go($file) {
		if (file_exists($file)) {
			$this -> file = realpath($file);
			return "Database '".$this -> name."' already exists.";
		}
		else {
			file_put_contents($file, "");
			$this -> file = realpath($file);
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
			$db = json_decode($old, true);
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
			$db = json_decode($old, true);
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
	 * @param  array $cols  the list of columns to get, empty for all
	 * @return array
	 */
	function select($cols = array()) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode($old, true);
			$result = array();
			$values = array();
			if ($cols === array()) {
				foreach ($db as $row) {
					foreach (array_keys($row) as $c) {
						$values[$c] = $row[$c];
					};
					if (values)
						$result[] = $values;
					$values = array();;
				}
			} else {
				foreach ($db as $row) {
					foreach ((array) $cols as $c) {
						if ($row[$c])
							$values[$c] = $row[$c];
					};
					if ($values)
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
			$db = json_decode($old, true);
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
			$db = json_decode($old, true);
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

	/**
	 * Matches keys and values based on a regular expression
	 * @param  array  $cols   the columns to return; an empty array returns all columns
	 * @param  string $key    the column whose value to match
	 * @param  string $regex  the regular expression to match
	 * @return array
	 */
	function like($cols,$key,$regex) {
		$old = file_get_contents($this -> file);
		if ($old) {
			$db = json_decode($old, true);
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

	/**
	 * Merges two databases and gets rid of duplicates
	 * @param  array $cols    the columns to merge
	 * @param  Fllat $second  the second database to merge
	 * @return array          the merged array
	 */
	function union($cols, $second) {
		return array_map("unserialize", array_unique(array_map("serialize",
			array_merge(
				$this -> select($cols),
				$second -> select($cols)
				))
		));
	}


	function join($method, $cols, $second, $match) {
		$_left = file_get_contents($this -> file);
		$_right = file_get_contents($second -> file);
		if ($_left && $_right) {
			$_left = json_decode($_left ,true);
			$_right = json_decode($_right ,true);
			$_result = array();
			$_values = array();
			if ($method === "inner") {
				foreach ($_left as $lrow) {
					foreach ($_right as $rrow) {
						if ($lrow[$match[0]] === $rrow[$match[1]]) {
							$_result[] = array_merge($lrow, $rrow);
						}
					}
				}
			} elseif ($method === "left") {
				foreach ($_left as $lrow) {
					foreach ($_right as $rrow) {
						if ($lrow[$match[0]] === $rrow[$match[1]]) {
							$_values = array_merge($lrow, $rrow);
							break;
						} else {
							$_values = $lrow;
						}
					}
					$_result[] = $_values;
					$_values = array();
				}
			} elseif ($method === "right") {
				foreach ($_left as $lrow) {
					foreach ($_right as $rrow) {
						if ($lrow[$match[0]] === $rrow[$match[1]]) {
							$_values = array_merge($lrow, $rrow);
							break;
						} else {
							$_values = $rrow;
						}
					}
					$_result[] = $_values;
					$_values = array();
				}
			}
			elseif ($method === "full") {
				$_result = array_map("unserialize", array_unique(array_map("serialize",
					array_merge(
						$this -> join("left", $cols, $second, $match),
						$this -> join("right", $cols, $second, $match)
						))
				));
			}
			return $_result;
		}
		else {
			return ;
		}
	}

	/**
	 * Counts the number of items per column or for all columns
	 * @param  string $col  the column name to count. No input counts all columns.
	 * @return int          the number of rows containing that column.
	 */
	function count($col = "") {
		if ($col === "") {
			$query = array();
		} else {
			$query = (array) $col;
		}
		return count($this -> select($query));
	}

	/**
	 * Gets the first item of a column
	 * @param  string $col  the column to look at
	 * @return mixed        the first item in the column
	 */
	function first($col) {
		return $this -> select((array) $col)[0][$col];
	}

	/**
	 * Gets the last item in a column
	 * @param  string $col the name of the column to look at
	 * @return mixed       the last item in the column
	 */
	function last($col) {
		return end($this -> select((array) $col))[$col];
	}

}

?>