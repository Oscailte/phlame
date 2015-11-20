<?php

namespace Phlame\Core\Components\Traits;

trait Sequence {

	public $sequence = array();

	public function addBefore($name, $value, array $before = array()) {
		$this->sequence[$name] = array(
			'value' => $value,
			'before' => $before
		);
		$new = array();
		$keys = array_keys($this->sequence);
		foreach ($keys as $pos => $name) {
			$before = $this->sequence[$name]['before'];
			//if (in_array($key, $before)) {
			//	$new[$name] = $value;
			//}
			$new[$name] = $this->sequence[$name];
		}
		$this->sequence = $new;
		return $this;
	}

	public function getAfter($name) {
		$keys = array_keys($this->sequence);
		foreach ($keys as $pos => $name) {
			$before = $this->sequence[$name]['before'];
			if (in_array($name, $before)) {
				//$after[]
			}
		}
	}

	public function sayHello() {
		echo 'Hello ';
	}

}
