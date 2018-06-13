<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\Merchant;

class MerchantTransformer implements Transformer {

	private $dateTransformer;
	private $merchantProfileTransformer;
	private $merchantClearingDistributionTransformer;

	public function __construct() {
		$this->dateTransformer = new DateTransformer();
		$this->merchantProfileTransformer = new MerchantProfileTransformer();
		$this->merchantClearingDistributionTransformer = new MerchantClearingDistributionTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return Merchant
	 */
	public function transform(array $data) {
		// merchant_profiles
		if (isset($data['merchant_profiles']) && isset($data['merchant_profiles']['data'])) {
			$data['merchant_profiles'] = array_map(function($merchantProfile) {
				return $this->merchantProfileTransformer->transform($merchantProfile);
			}, $data['merchant_profiles']['data']);
		}

		// clearing_distribution
		if (isset($data['clearing_distribution']) && isset($data['clearing_distribution']['data'])) {
			$data['clearing_distribution'] = array_map(function($clearingDistribution) {
				return $this->merchantClearingDistributionTransformer->transform($clearingDistribution);
			}, $data['clearing_distribution']['data']);
		}


		return new Merchant($this->dateTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return array
	 */
	public function reverseTransform(Model $model) {
		$data = $model->getData();

		// clearing_distribution
		if (isset($data['clearing_distribution'])) {
			$data['clearing_distribution'] = array_map(function($clearingDistribution) {
				if ($clearingDistribution instanceof Model) {
					return $this->merchantClearingDistributionTransformer->reverseTransform($clearingDistribution);
				}

				return $clearingDistribution;
			}, $data['clearing_distribution']);
		}

		return $this->dateTransformer->reverseTransform($data);
	}
}