<?php
namespace Mrself\YaF\Form;

class View {

	public function __construct($data = null) {
		if ($data) {
			$this->data = $data;
		}
	}

	public function with($key, $val) {
		if (is_array($key)) {
			$this->data = array_merge($this->data, $key);
		} else {
			$this->data[$key] = $val;
		}

	}

	public function setPath($path) {
		$this->path = $path;
	}

	public function render() {
		return view($this->path, $this->data);
	}

}