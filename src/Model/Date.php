<?php


namespace Nocks\SDK\Model;

/**
 * Class Date
 *
 * @method getTimestamp()
 *
 * @package Nocks\SDK\Model
 */
class Date extends Model {

	private $dateTime = null;

	public function __construct($data) {
		parent::__construct($data);

		if ($this->hasTimestamp()) {
			$this->dateTime = new \DateTime();
			$this->dateTime->setTimestamp($this->getTimestamp());
		}
	}

	/**
	 * Has DateTime
	 *
	 * @return bool
	 */
	public function hasDateTime() {
		return $this->dateTime !== null;
	}

	/**
	 * Get DateTime
	 *
	 * @return \DateTime|null
	 */
	public function getDateTime() {
		return $this->dateTime;
	}
}