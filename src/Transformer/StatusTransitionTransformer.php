<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\StatusTransition;

class StatusTransitionTransformer implements Transformer {

	private $dateTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return StatusTransition
	 */
	public function transform(array $data) {
		return new StatusTransition($this->dateTransformer->transform($data));
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