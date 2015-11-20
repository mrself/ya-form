<?php

namespace Mrself\YaF\Form;

class Field {

	public function setData($data) {
		$this->data = $data;
	}

	public function make($fieldData, $seedData) {
		$inst = new static;
		$inst->fieldData = $fieldData;
		$inst->seedData = $seedData;
	}

	public function render() {
		return view('ya-form::fields.' + $this->fieldData['type'])
	}
}