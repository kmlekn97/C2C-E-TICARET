<?php
class ArrayList{

	private $array;

	public function __construct($array) {
		$this->array = $array;
		//parent::__construct();
	}

	public function count() {
		return count($this->array);
	}

	public function toArray() {
		return $this->array;
	}

	public function toNestedArray() {
		$result = array();

		foreach ($this->array as $item) {
			if (is_object($item)) {
				if (method_exists($item, 'toMap')) {
					$result[] = $item->toMap();
				} else {
					$result[] = (array) $item;
				}
			} else {
				$result[] = $item;
			}
		}

		return $result;
	}

	public function getRange($offset, $length) {
		return array_slice($this->array, $offset, $length);
	}

	public function add($item) {
		$this->array[] = $item;
	}

	public function remove($item) {
		foreach ($this->array as $key => $value) {
			if ($item === $value) unset($this->array[$key]);
		}
	}

	public function first() {
		return reset($this->array);
	}

	public function last() {
		return end($this->array);
	}

	public function map($keyfield, $titlefield) {
		$map = array();
		foreach ($this->array as $item) {
			$map[$this->extract($item, $keyfield)] = $this->extract($item, $titlefield);
		}
		return $map;
	}

	public function find($key, $value) {
		foreach ($this->array as $item) {
			if ($this->extract($item, $key) == $value) return $item;
		}
	}

	public function column($field) {
		$result = array();
		foreach ($this->array as $item) {
			$result[] = $this->extract($item, $field);
		}
		return $result;
	}

	public function canSortBy($by) {
		return true;
	}

	public function sort($by, $dir = 'ASC') {
		$sorts = array();
		$dir   = strtoupper($dir) == 'DESC' ? SORT_DESC : SORT_ASC;

		foreach ($this->array as $item) {
			$sorts[] = $this->extract($item, $by);
		}

		array_multisort($sorts, $dir, $this->array);
	}

	public function offsetExists($offset) {
		return array_key_exists($offset, $this->array);
	}

	public function offsetGet($offset) {
		if ($this->offsetExists($offset)) return $this->array[$offset];
	}

	public function offsetSet($offset, $value) {
		$this->array[$offset] = $value;
	}

	public function offsetUnset($offset) {
		unset($this->array[$offset]);
	}

	protected function extract($item, $key) {
		return is_object($item) ? $item->$key : $item[$key];
	}

}