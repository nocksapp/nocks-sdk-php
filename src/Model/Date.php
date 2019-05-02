<?php


namespace Nocks\SDK\Model;


use DateTime;

/**
 * Class Date
 *
 * @package Nocks\SDK\Model
 */
class Date extends Model {

	private $dateTime = null;

	public function __construct(array $data = []) {
		parent::__construct($data);

		if ($this->hasTimestamp()) {
			$this->dateTime = new DateTime();
			$this->dateTime->setTimestamp($this->getTimestamp());
		}
	}

	/**
	 * Set DateTime
	 *
	 * @param DateTime $dateTime
	 */
	public function setDateTime(DateTime $dateTime) {
		$this->dateTime = $dateTime;
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
	 * @return DateTime|null
	 */
	public function getDateTime() {
		return $this->dateTime;
	}
}