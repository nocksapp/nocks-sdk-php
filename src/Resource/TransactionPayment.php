<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Model\Payment;

class TransactionPayment {

	private $resourceHelper;

	public function __construct(ResourceHelper $resourceHelper) {
		$this->resourceHelper = $resourceHelper;
	}

	/**
	 * Override the baseUrl in the requestOptions
	 *
	 * @param $transactionUuid
	 */
	private function setBaseUrl($transactionUuid) {
		$this->resourceHelper->requestOptions['baseUrl'] = $this->resourceHelper->getScope()->getBaseUrl() .
		                                                   'transaction/' . $transactionUuid . '/payment';
	}

	/**
	 * Create a new payment in a transaction
	 *
	 * @param $transactionUuid
	 * @param Payment $payment
	 *
	 * @return \Nocks\SDK\Model\Payment
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function create($transactionUuid, Payment $payment) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($transactionUuid);

		return $this->resourceHelper->create($payment);
	}

	/**
	 * Cancel a payment (inside a transaction)
	 *
	 * @param $transactionUuid
	 * @param $uuid
	 *
	 * @return void
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function cancel($transactionUuid, $uuid) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($transactionUuid);

		$this->resourceHelper->delete($uuid);
	}
}