<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\Setting;

class SettingTransformer implements Transformer {

	private $paymentMethodTransformer;

	public function __construct() {
		$this->paymentMethodTransformer = new PaymentMethodTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return Setting
	 */
	public function transform(array $data) {
		// payment_methods
		if (isset($data['payment_methods'])) {
			$data['payment_methods'] = array_map(function($paymentMethod) {
				return $this->paymentMethodTransformer->transform($paymentMethod);
			}, $data['payment_methods']);
		}

		return new Setting($data);
	}

	/**
	 * @param Model $model
	 *
	 * @return array
	 */
	public function reverseTransform(Model $model) {
		return $model->getData();
	}
}