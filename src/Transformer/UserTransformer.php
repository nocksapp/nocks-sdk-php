<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\User;

class UserTransformer implements Transformer {

	private $dateTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param $data
	 *
	 * @return User
	 */
	public function transform(array $data) {
		return new User($this->dateTransformer->transform($data));
	}

	/**
	 * @param Model $user
	 *
	 * @return array
	 */
	public function reverseTransform(Model $user) {
		return $this->dateTransformer->reverseTransform($user->getData());
	}
}