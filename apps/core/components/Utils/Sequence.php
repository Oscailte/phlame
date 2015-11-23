<?php

/*
 * This component extends a standard array
 * It acts like a dependency tree
 * After each addition,
 *   1. it enables any requirements recursively
 *   2. it re-sorts itself according to requirements
 * 
 * Array entries should be in the form:
 * array('name' => 'item1', 'enable' => true, 'require' => array('item2', 'item3'))
 * 
*/ 


namespace Phlame\Core\Components\Utils;

use ArrayObject;

class Sequence extends ArrayObject {
	
	protected $_index_name = 'name';
	protected $_index_require = 'require';
	protected $_index_enable = 'enable';
	protected $_enabled = array();

	public function __construct() {
		parent::__construct();
	}

	public function enable($name) {
		//echo 'enabling '.$name.'<br/>';
		if (!empty($this[$name])) {
			//echo '- index exists for '.$name.'<br/>';
			if (empty($this[$name][$this->_index_enable])) {
				//echo '- setting '.$name.' as enabled<br/>';
				$this[$name][$this->_index_enable] = true;
			}
			foreach ($this[$name][$this->_index_require] as $require) {
				//echo '- also enabling '.$require.'<br/>';
				$this->enable($require);
			}			
		}
		if (!in_array($name, $this->_enabled)) {
			//echo '- adding '.$name.' to enabled array<br/>';
			$this->_enabled[] = $name;
		}
		//echo 'done with '.$name.'<br/>';
	}

	public function offsetSet($key, $value) {
		
		// set the value
		parent::offsetSet($key, $value);

		// if the item is enabled or required by something else enabled
		// then enable it and all related requires
		if ($value[$this->_index_enable] || in_array($value[$this->_index_name], $this->_enabled)) {
			$this->enable($value[$this->_index_name]);
		}		
		
		// re-sort the array
		$this->uasort(array($this, 'compare'));
		
	}
	
	public function compare($item1, $item2) {
		//echo 'compare '.$item1['name'].' and '.$item2['name'].' : ';
		// return -1 if item1 should come before item2
		// return 1 if item1 should come after item2
		// return 0 if we dont care
		if (in_array($item1[$this->_index_name], $item2[$this->_index_require])) {
			//echo $item2['name'].' requires '.$item1['name'].' : return -1<br/>';
			return -1;
		}
		if (in_array($item2[$this->_index_name], $item1[$this->_index_require])) {
			//echo $item1['name'].' requires '.$item2['name'].' : return 1<br/>';
			return 1;
		}
		//echo 'return 0<br/>';
		return 0;
	}

}
