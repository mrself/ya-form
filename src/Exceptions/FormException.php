<?php

namespace Mrself\YaF\Exceptions;

class FormException extends \Exception {

	public function __construct($message, $code = 0, $previous = null) {
		parent::__construct($this->makeMessage($code, $message), $code, $previous);
	}

	public function makeMessage($code, $args = []) {
		switch ($code) {
			case 1:
				$message = $this->notFoundViewForType($args);
				break;

			default:
				$message = 'Unknown error';
				break;
		}
		return $this->wrapMessage($message);
	}

	public function notFoundViewForType($args) {
		return sprintf('There is no template for the %s field with type %s', $args['name'], $args['type']);
	}

	public function wrapMessage($message) {
		return 'Ya-form error: ' . $message;
	}
}