<?php


namespace Nocks\SDK\Transformer;


use Nocks\SDK\Model\Model;
use Nocks\SDK\Model\TransactionQuote;

class TransactionQuoteTransformer implements Transformer {

	private $currencyTransformer;

	public function __construct() {
		$this->currencyTransformer = new CurrencyTransformer();
	}

	/**
	 * @param array $data
	 *
	 * @return TransactionQuote
	 */
	public function transform(array $data) {
		return new TransactionQuote($this->currencyTransformer->transform($data));
	}

	/**
	 * @param Model $model
	 *
	 * @return mixed
	 */
	public function reverseTransform(Model $model) {
		return $this->currencyTransformer->reverseTransform($model->getData());
	}
}