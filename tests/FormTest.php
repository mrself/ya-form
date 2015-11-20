<?php

use Mrself\YaF\Form\Form;

class FormTest extends Orchestra\Testbench\TestCase {

	private function init() {
		
	}

	public function testSetName() {
		$form = \App::make('YaF');
		$form->setName('test');
		$this->assertTrue($form->getName() == 'test');
	}

	public function all() {
		$form = \App::make('YaF');
		$form->setName('test');
		$form->setDName('node');
		$form->init($this->getSeedData(), $this->getFieldsData(), $this->getArgs());
		$this->assertTrue(true);
	}

	protected function getPackageProviders($app) {
	    return ['Mrself\YaF\YaFormServiceProvider'];
	}

	public function getSeedData() {
		return [
			// 'title' => 'My title'
		];
	}

	public function getFieldsData() {
		return [
			[
				'type' => 'text',
				'label' => 'Title',
				'name' => 'title',
				'rowView' => 'customText'
			],

			[
				'name' => 'terms',
				'type' => 'select',
			]
			
		];
	}

	public function getArgs() {
		return [
			'title' => ['classes' => 'js-title'],
			'terms' => [
				'values' => [
					'1' => 'Term 1',
					'5' => 'Term 2'
				]
			]
		];
	}
}