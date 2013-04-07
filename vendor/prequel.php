<?php

/**
 * Prequel: SQL-based manipulations for PHP arrays. Select. Where. Like. Union. Join.
 * 
 * Copyright MMXIII Alfred Xing http://alfredxing.com/
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, and/or sublicense copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

class Prequel
{

	/**
	 * Get a set of columns for all rows
	 * @param  array $cols  the list of columns to get, empty for all
	 * @return array
	 */
	function select($cols = array(), $db) {
		$_result = array();
		$_values = array();
		if ($cols === array()) {
			foreach ($db as $row) {
				foreach (array_keys($row) as $c) {
					$_values[$c] = $row[$c];
				};
				if (values)
					$_result[] = $values;
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