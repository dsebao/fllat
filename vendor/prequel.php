<?php

/**
 * Prequel: SQL-based manipulations for PHP arrays.
 * Select. Where. Like. Union. Join.
 * 
 * PHP version 5
 *
 * @author    Alfred Xing <xing@lfred.info>
 * @copyright 2013 Alfred Xing
 * @license   LICENSE.md MIT License
 * 
 */

class Prequel
{

	/**
	 * Get a set of columns for all rows
	 * 
	 * @param array $cols the list of columns to get, empty for all
	 * @param array $db   the array to select from
	 * 
	 * @return array
	 */
	function select($cols, $db)
	{
		$_result = array();
		$_values = array();
		if ($cols === array()) {
			foreach ($db as $row) {
				foreach (array_keys($row) as $c) {
					$_values[$c] = $row[$c];
				};
				if ($_values)
					$_result[] = $_values;
				$_values = array();
			}
		} else {
			foreach ($db as $row) {
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
	}

}

$prequel = new Prequel();

?>