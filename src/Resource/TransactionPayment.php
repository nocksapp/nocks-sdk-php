<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Model\Payment;
use Nocks\SDK\Model\PaymentRefund;
use Nocks\SDK\Transformer\PaymentRefundTransformer;

class TransactionPayment {

	private $resourceHelper;
	private $paymentRefundTransformer;

	public function __construct(ResourceHelper $resourceHelper, PaymentRefundTransformer $paymentRefundTransformer) {
		$this->resourceHelper = $resourceHelper;
		$this->paymentRefundTransformer = $paymentRefundTransformer;
	}

	/**
	 * Override the baseUrl in the requestOptions
	 *
	 * @param $transactionUuid
	 */
	private function setBaseUrl($transactionUuid = null) {
		if ($transactionUuid === null) {
			$this->resourceHelper->requestOptions['baseUrl'] = $this->resourceHelper->getScope()->getBaseUrl() .
			                                                   'payment';
		} else {
			$this->resourceHelper->requestOptions['baseUrl'] = $this->resourceHelper->getScope()->getBaseUrl() .
			                                                   'transaction/' . $transactionUuid . '/payment';
		}
	}

	/**
	 * Create a new payment in a transaction
	 *
	 * @param $transactionUuid
	 * @param Payment $payment
	 *
	 * @return Payment
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
	 * @param $uuid
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
	public function findOne($uuid) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl();

		return $this->resourceHelper->findOne($uuid);
	}

	/**
	 * Cancel a payment
	 *
	 * @param $uuid
	 * @param $paymentUuid - deprecated backward compatibility
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
	public function cancel($uuid, $paymentUuid = null) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl();

		$this->resourceHelper->delete($paymentUuid === null ? $uuid : $paymentUuid);
	}

	/**
	 * Refund a payment
	 *
	 * @param $uuid
	 * @param PaymentRefund $refund
	 *
	 * @return PaymentRefund
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
	public function refund($uuid, PaymentRefund $refund) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl();

		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'url' => '/' . $uuid . '/refund',
			'method' => 'POST',
			'data' => $this->resourceHelper->getTransformer()->reverseTransform($refund),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->paymentRefundTransformer->transform($data);
		});
	}
}