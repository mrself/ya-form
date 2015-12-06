<?php

class Collection {

	public static function make($rows) {
		$inst = new self;
		$inst->set($rows);
		return $inst;
	}

	public function set($rows) {
		$this->rows = $rows;
	}

	public function only($names) {
		return array_only($this->rows, $names);
	}

	public function forget() {
		
	}
}