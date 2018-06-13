<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\MerchantProfile;

class MerchantProfileTransformer implements Transformer {

	private $dateTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return MerchantProfile
	 */
	public function transform(array $data) {
		return new MerchantProfile($this->dateTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->dateTransformer->reverseTransform($model->getData());
	}
}