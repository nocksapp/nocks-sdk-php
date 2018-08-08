<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\BalanceTransfer;

class BalanceTransferTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;
	private $paymentMethodTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
		$this->paymentMethodTransformer = new PaymentMethodTransformer();
	}

	/**
	 * Transform balanceTransfer
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function transform(array $data) {
		if (isset($data['payment_method']) && isset($data['payment_method']['data'])) {
			$data['payment_method'] = $this->paymentMethodTransformer->transform($data['payment_method']['data']);
		}

		return new BalanceTransfer($this->dateTransformer->transform($this->currencyTransformer->transform($data)));
	}

	/**
	 * Reverse transform balanceTransfer
	 *
	 * @param $balanceTransfer
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $balanceTransfer) {
		return $balanceTransfer->getData();
	}
}