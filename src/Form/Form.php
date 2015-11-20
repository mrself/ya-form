<?php

namespace Mrself\YaF\Form;

class Form {

	protected $fields = [];
	protected $name;
	public $dName;
	protected $viewData = [];

	public function __construct() {
		$this->view = \App::make('Mrself\YaF\Form\View');
	}

	public static function make ($values, $fields, $arguments = []) {
		$inst = new static;
		$inst->values = $values;
		$inst->fieldsAttrs = $fields;
		$inst->arguments = $arguments;
		return $inst;
	}

	public function init($values, $fields, $arguments = []) {
		$this->values = $values;
		$this->fieldsAttrs = $fields;
		$this->arguments = $arguments;
		$this->initFields();
	}

	public function initFields() {
		foreach ($this->fieldsAttrs as $key => $field) {
			$row = new Row();
			$row->setFormName($this->getName());
			$row->setAttrs($field);
			$row->setValue($this->getValue($field['name']));
			$row->setArgs($this->getArgs($field['name']));
			$this->fields[$field['name']] = $row;
		}
	}

	protected function getValue($fieldName) {
		if (!empty($this->values[$fieldName])) {
			return $this->values[$fieldName];
		}
		return '';
	}

	protected function getArgs($fieldName) {
		if (!empty($this->arguments[$fieldName])) {
			return $this->arguments[$fieldName];
		}
		return [];
	}


	public function setName($name = null) {
		if (!$name) {
			$name = substr(uniqid(), 6);
		}
		$this->view->with('formName', $name);
		$this->name = $name;
	}

	public function setDName($dName) {
		$this->view->with('dName', $dName);
		$this->dName = $dName;
	}

	public function getName() {
		if (isset($this->name)) {
			return $this->name;
		} else {
			$this->setName();
			return $this->name;
		}
	}

	public function render() {
		$html = '';
		foreach ($this->fields as $name => $field) {
			$html .= $field->render($this->view);
		}
		return $html;
	}

	public function __get($name) {
		if (isset($this->fields[$name]))
			return $this->fields[$name];
		else {
			return null;
		}
	}

	
}