<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\Transaction;

class TransactionTransformer implements Transformer {

	private $currencyTransformer;
	private $dateTransformer;
	private $paymentTransformer;
	private $statusTransitionTransformer;
	private $paymentMethodTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
		$this->dateTransformer = new DateTransformer();
		$this->paymentTransformer = new PaymentTransformer();
		$this->statusTransitionTransformer = new StatusTransitionTransformer();
		$this->paymentMethodTransformer = new PaymentMethodTransformer();
	}

	/**
	 * Transform transaction
	 *
	 * @param $data
	 *
	 * @return Transaction
	 */
	public function transform(array $data) {
		// Payments
		if (isset($data['payments']) && isset($data['payments']['data'])) {
			$data['payments'] = array_map(function($payment) {
				return $this->paymentTransformer->transform($payment);
			}, $data['payments']['data']);
		}

		// Status transitions
		if (isset($data['status_transitions']) && isset($data['status_transitions']['data'])) {
			$data['status_transitions'] = array_map(function($statusTransition) {
				return $this->statusTransitionTransformer->transform($statusTransition);
			}, $data['status_transitions']['data']);
		}

		// Payment method
		if (isset($data['payment_method']) && isset($data['payment_method']['data'])) {
			$data['payment_method'] = $this->paymentMethodTransformer->transform($data['payment_method']['data']);
		}

		return new Transaction($this->dateTransformer->transform($this->currencyTransformer->transform($data)));
	}

	/**
	 * Reverse transform transaction
	 *
	 * @param $transaction
	 *
	 * @return array
	 */
	public function reverseTransform(Model $transaction) {
		$data = $transaction->getData();

		// Payments
		if (isset($data['payments'])) {
			$data['payments'] = array_map(function($payment) {
				if ($payment instanceof Model) {
					return $this->paymentTransformer->reverseTransform($payment);
				}

				return $payment;
			}, $data['payments']);
		}

		// Status transitions
		if (isset($data['status_transitions'])) {
			$data['status_transitions'] = array_map(function($statusTransition) {
				if ($statusTransition instanceof Model) {
					return $this->statusTransitionTransformer->reverseTransform($statusTransition);
				}

				return $statusTransition;
			}, $data['status_transitions']);
		}

		// Payment method
		if (isset($data['payment_method']) && $data['payment_method'] instanceof Model) {
			$data['payment_method'] = $this->paymentMethodTransformer->reverseTransform($data['payment_method']);
		}

		return $this->dateTransformer->reverseTransform($this->currencyTransformer->reverseTransform($data));
	}
}