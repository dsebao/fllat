<?php

/**
 * Fllat: A flat file database system. Driven by PHP. Stores data in JSON. SQL based data fetching.
 * 
 * Copyright MMXIII Alfred Xing http://alfredxing.com/
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, and/or sublicense copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

require("prequel.php");

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
		$_old = file_get_contents($this -> file);
		if ($_old) {
			$_db = json_decode(file_get_contents($this -> file),true);
		}
		else {
			$_db = array();
		};
		$_db[] = $data;
		$this -> rw($_db);
	}

	/**
	 * Get the row where the value matches that of the key and return the value of the other key
	 * @param  string $col
	 * @param  string $key
	 * @param  string $val
	 * @return array
	 */
	function get($col,$key,$val) {
		$_old = file_get_contents($this -> file);
		if ($_old) {
			$_db = json_decode($_old, true);
			foreach ($_db as $row) {
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
		$_old = file_get_contents($this -> file);
		if ($_old) {
			$_db = json_decode($_old, true);
			$_result = false;
			foreach ($_db as $row) {
				if ($row[$key] === $val) {
					$_result = true;
				}
			}
			return $_result;
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
		$_old = file_get_contents($this -> file);
		if ($_old) {
			$_db = json_decode($_old, true);
			$_result = array();
			$_values = array();
			if ($cols === array()) {
				foreach ($_db as $row) {
					foreach (array_keys($row) as $c) {
						$_values[$c] = $row[$c];
					};
					if (values)
						$_result[] = $_values;
					$_values = array();;
				}
			} else {
				foreach ($_db as $row) {
					foreach ((array) $cols as $c) {
						if ($row[$c])
							$_values[$c] = $row[$c];
					};
					if ($_values)
						$_result[] = $_values;
					$_values = array();
				}
			}
			return $_result;
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
		$_old = file_get_contents($this -> file);
		if ($_old) {
			$_db = json_decode($_old, true);
			$_result = array();
			$_values = array();
			if ($cols === array()) {
				foreach ($_db as $row) {
					if ($row[$key] === $val) {
						foreach (array_keys($row) as $c) {
							$_values[$c] = $row[$c];
						};
						$_result[] = $_values;
						$_values = array();
					}
				}
			} else {
				foreach ($_db as $row) {
					if ($row[$key] === $val) {
						foreach ((array) $cols as $c) {
							$_values[$c] = $row[$c];
						};
						$_result[] = $_values;
						$_values = array();
					};
				}
			}
			return $_result;
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
		$_old = file_get_contents($this -> file);
		if ($_old) {
			$_db = json_decode($_old, true);
			$_result = array();
			$_values = array();
			if ($cols === array()) {
				foreach ($_db as $row) {
					if (in_array($row[$key],$val)) {
						foreach (array_keys($row) as $c) {
							$_values[$c] = $row[$c];
						};
						$_result[] = $_values;
						$_values = array();
					}
				}
			} else {
				foreach ($_db as $row) {
					if (in_array($row[$key],$val)) {
						foreach ((array) $cols as $c) {
							$_values[$c] = $row[$c];
						};
						$_result[] = $_values;
						$_values = array();
					};
				}
			}
			return $_result;
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
		$_old = file_get_contents($this -> file);
		if ($_old) {
			$_db = json_decode($_old, true);
			$_result = array();
			$_values = array();
			if ($cols === array()) {
				foreach ($_db as $row) {
					if (preg_match($regex, $row[$key])) {
						foreach (array_keys($row) as $c) {
							$_values[$c] = $row[$c];
						};
						$_result[] = $_values;
						$_values = array();
					}
				}
			} else {
				foreach ($_db as $row) {
					if (preg_match($regex, $row[$key])) {
						foreach ((array) $cols as $c) {
							$_values[$c] = $row[$c];
						};
						$_result[] = $_values;
						$_values = array();
					};
				}
			}
			return $_result;
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

	/**
	 * Matches and merges columns between 
	 * @param  string $method  the method to join (inner, left, right, full)
	 * @param  array  $cols    the columns to select
	 * @param  Fllat  $second  the second database to consider
	 * @param  array  $match   a key-value pair: left column to match => right column
	 * @return array           joined array
	 */
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
						if ($lrow[array_keys($match)[0]] === $rrow[array_values($match)[0]]) {
							$_result[] = array_merge($lrow, $rrow);
						}
					}
				}
			} elseif ($method === "left") {
				foreach ($_left as $lrow) {
					foreach ($_right as $rrow) {
						if ($lrow[array_keys($match)[0]] === $rrow[array_values($match)[0]]) {
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
						if ($lrow[array_keys($match)[0]] === $rrow[array_values($match)[0]]) {
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
			return $GLOBALS["prequel"] -> select($cols, $_result);
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