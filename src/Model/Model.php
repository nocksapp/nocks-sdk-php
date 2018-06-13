<?php


namespace Nocks\SDK\Model;

use Nocks\SDK\Util;

abstract class Model {

	private $data;

	public function __construct(array $data = []) {
		$this->data = $data;
	}

	public function getData() {
		return $this->data;
	}

	/**
	 * Get the id for the model
	 *
	 * @return mixed|null
	 */
	public function getId() {
		return $this->uuid;
	}

	/**
	 * Magic setter
	 *
	 * @param $name
	 * @param $value
	 */
	public function __set($name, $value) {
		$this->data[Util::camelCaseToSnakeCase($name)] = $value;
	}

	/**
	 * Magic getter
	 *
	 * @param $name
	 *
	 * @return mixed|null
	 */
	public function __get($name) {
		if (isset($this->data[$name])) {
			return $this->data[$name];
		}

		$snakeCaseName = Util::camelCaseToSnakeCase($name);

		if (isset($this->data[$snakeCaseName])) {
			return $this->data[$snakeCaseName];
		}

		return null;
	}

	/**
	 * Magic isset
	 *
	 * @param $name
	 *
	 * @return bool
	 */
	public function __isset($name) {
		return $this->{$name} !== null;
	}

	/**
	 * Magic call for getters, setters and is, has checks
	 *
	 * @param $name
	 * @param $arguments
	 *
	 * @return bool|mixed|null
	 */
	public function __call($name, $arguments) {
		if (Util::startsWith($name, 'get') && count($arguments) === 0) {
			// Get
			return $this->{substr($name, 3)};
		} elseif (Util::startsWith($name, 'set') && count($arguments) === 1) {
			// Set
			$this->{substr($name, 3)} = $arguments[0];
		} elseif (Util::startsWith($name, 'has') && count($arguments) === 0) {
			// Has
			return isset($this->{substr($name, 3)});
		}

		return null;
	}
}