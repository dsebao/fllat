<?php

class db {

	function __construct($name) {
		$this->name = $name;
		$this->file = 'db/'.$this->name.'.dat';
	}

	function go() {
		if (file_exists($this->file)) {
			return "Database '".$this->name."' already exists.";
		}
		else {
			file_put_contents($this->file, "");
			return "Database '".$this->name."' successfully created.";
		}
	}

	function rm() {
		if (file_exists($this->file)) {
			unlink($this->file);
			return "Database '".$this->name."' successfully deleted.";
		}
		else {
			return "Database '".$this->name."' doesn't exist.";
		}
	}

	function rw($data) {
		file_put_contents($this->file, json_encode($data));
	}

	function add($data) {
		$old = file_get_contents($this->file);
		if ($old) {
			$wk = json_decode(file_get_contents($this->file),true);
		}
		else {
			$wk = [];
		};
		$wk[array_keys($data)[0]] = $data[array_keys($data)[0]];
		$this->rw($wk);
	}

	function get($key) {
		$old = file_get_contents($this->file);
		if ($old) {
			$wk = json_decode(file_get_contents($this->file),true);
			if ($wk[$key]) {
				return $wk[$key];
			}
			else {
				return "Not found.";
			}
		}
		else {
			return "Not found.";
		};
	}

}

$wylst = new db("wylst");
$wylst->go();

?>