<?php

namespace Mrself\YaF\Form;

class Form {

	protected $rows = [];
	protected $name;
	public $dName;
	protected $viewData = [];
	protected $groups = [];

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
		$this->setFields();
	}

	public function setFields() {
		foreach ($this->fieldsAttrs as $key => $field) {
			$this->setRow($field['name'], $field);
		}
	}

	public function setGroups($groups) {
		$this->groups = $groups;
	}

	protected function makeRow($attrs) {
		$row = new Row();
		$row->setFormName($this->getName());
		$row->setAttrs($attrs);
		$row->setValue($this->getValue($attrs['name']));
		$row->setArgs($this->getArgs($attrs['name']));
		return $row;
	}

	protected function setRow($name, $attrs) {
		$this->rows[$name] = $this->makeRow($attrs);
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
		foreach ($this->rows as $name => $row) {
			$html .= $row->render($this->view);
		}
		return $html;
	}

	public function renderGroup($name) {
		$html = '';
		foreach ($this->groups[$name] as $rowName) {
			$html .= $this->rows[$rowName]->render($this->view);
		}
		return $html;
	}

	public function __get($name) {
		if (isset($this->rows[$name]))
			return $this->rows[$name];
		else {
			return null;
		}
	}

	
}