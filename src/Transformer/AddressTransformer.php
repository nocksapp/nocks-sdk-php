<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\Address;

class AddressTransformer implements Transformer {

	private $dateTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param $data
	 *
	 * @return Address
	 */
	public function transform(array $data) {
		return new Address($this->dateTransformer->transform($data));
	}

	/**
	 * @param Model $address
	 *
	 * @return array
	 */
	public function reverseTransform(Model $address) {
		return $this->dateTransformer->reverseTransform($address->getData());
	}
}