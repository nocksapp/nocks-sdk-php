<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\NotificationFilter;

class NotificationFilterTransformer implements Transformer {

	private $dateTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param $data
	 *
	 * @return NotificationFilter
	 */
	public function transform(array $data) {
		return new NotificationFilter($this->dateTransformer->transform($data));
	}

	/**
	 * @param Model $notificationFilter
	 *
	 * @return array
	 */
	public function reverseTransform(Model $notificationFilter) {
		return $this->dateTransformer->reverseTransform($notificationFilter->getData());
	}
}