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

	public static function make ($values, $rows, $arguments = []) {
		$inst = new static;
		$inst->values = $values;
		$inst->rowsAttrs = $rows;
		$inst->arguments = $arguments;
		return $inst;
	}

	public static function model($modelInst) {
		$inst = new static;
		$inst->values = \Reqest::old();
		if (empty($inst->values)) {
			$inst->values = $modelInst->toArray();
		}
		$inst->rowAttrs = $modelInst->fields;
		return $inst;
	}

	public function init($values, $rows, $arguments = []) {
		$oldInput = \Request::old();
		if (!count($oldInput)) {
			$this->values = $values;
		} else {
			$this->values = $oldInput;
		}
		$this->rowsAttrs = $rows;
		$this->arguments = $arguments;
		$this->setRows();
	}

	public function setRows() {
		foreach ($this->rowsAttrs as $key => $row) {
			$this->setRow($row['name'], $row);
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

	protected function getValue($rowName) {
		if (!empty($this->values[$rowName])) {
			return $this->values[$rowName];
		}
		return '';
	}

	protected function getArgs($rowName) {
		if (!empty($this->arguments[$rowName])) {
			return $this->arguments[$rowName];
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
		// dd($this->groups);
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