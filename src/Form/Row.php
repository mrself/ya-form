<?php

namespace Mrself\YaF\Form;

class Row {

	public $name;
	public $attrs;
	public $seedData;
	protected $rowView;

	protected $defaultType = 'text';


	public static function make($attrs, $value, $formName) {
		$inst = new static;
		$inst->value = $value;
		$inst->setFormName($formName);
		$inst->setAttrs($attrs);
		return $inst;
	}

	public function setDefaultType($type) {
		$this->defaultType = $type;
	}

	public function setValue($value) {
		$this->value = $value;
	}

	public function setArgs($args) {
		$this->args = $args;
	}


	public function setAttrs($attrs) {
		foreach (array_only($attrs, ['label', 'type', 'name', 'rowView', 'dName']) as $key => $val) {
			$this->{$key} = $val;
		}
		if (!isset($attrs['label'])) {
			$this->label = ucfirst($this->name);
		}
		if (!isset($attrs['type'])) {
			$this->type = $this->defaultType;
		}
		if (!isset($attrs['id'])) {
			$this->id = $this->formName . '-' .$this->name;
		}
	}

	public function setFormName($name) {
		$this->formName = $name;
	}


	public function render($view) {
		$view->setPath($this->makeRowPath($this->rowView));
		$this->viewFieldPath = $this->makeViewPath('fields', $this->type);
		$view->with('row', $this);
		return $view->render();
	}

	private function makeRowPath($view = null) {
		if (!$view) {
			$view = 'default';
		}
		return $this->makeViewPath('rows', $view);
	}

	private function makeViewPath($section, $file) {
		return 'ya-form::' . $section . '.' . $file;
	}



}