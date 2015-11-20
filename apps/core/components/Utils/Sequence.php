<?php

/*
 * This component extends a standard array
 * It acts like a dependency tree
 * After each addition, it re-sorts itself according to dependencies
 * 
 * Array entries should be in the form:
 * array('name' => 'item1', 'require' => array('item2', 'item3'))
 * 
*/ 


namespace Phlame\Core\Components\Utils;

use ArrayObject;

class Sequence extends ArrayObject {

	public function __construct() {
		//parent::setFlags(parent::ARRAY_AS_PROPS);
		parent::__construct();
	}

	public function offsetSet($key, $value) {
		//echo 'set '.$key.'<br/>';
		parent::offsetSet($key, $value);
		$this->uasort(array($this, 'compare'));
	}
	
	//public function __set($name, $val) {
	//	echo 'set '.$name.'<br/>';
	//	$this[$name] = $val;
	//	//parent::__set($name, $val);
	//	$this->sort();
	//}
    
	//public function sort() {
	//	echo 'sorting<br/>';
	//	uasort($this, array($this, 'compare'));
	//}

	public function compare($item1, $item2) {
		//echo 'compare '.$item1['name'].' and '.$item2['name'].' : ';
		// return -1 if item1 should come before item2
		// return 1 if item1 should come after item2
		// return 0 if we dont care
		if (in_array($item1['name'], $item2['require'])) {
			//echo $item2['name'].' requires '.$item1['name'].' : return -1<br/>';
			return -1;
		}
		if (in_array($item2['name'], $item1['require'])) {
			//echo $item1['name'].' requires '.$item2['name'].' : return 1<br/>';
			return 1;
		}
		//echo 'return 0<br/>';
		return 0;
	}

}
