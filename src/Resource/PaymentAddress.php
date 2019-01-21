<?php


namespace Nocks\SDK\Resource;

use Nocks\SDK\Model\PaymentAddressValidationResult;

class PaymentAddress {

	private $resourceHelper;

	public function __construct(ResourceHelper $resourceHelper) {
		$this->resourceHelper = $resourceHelper;
	}

	/**
	 * @param \Nocks\SDK\Model\PaymentAddress $paymentAddress
	 *
	 * @return \Nocks\SDK\Model\PaymentAddress
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function validate(\Nocks\SDK\Model\PaymentAddress $paymentAddress) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'POST',
			'data' => $paymentAddress->getData(),
			'url' => '/validate',
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) use ($paymentAddress) {
			return new \Nocks\SDK\Model\PaymentAddress(array_merge($paymentAddress->getData(), $data));
		});
	}

	/**
	 * Validate an array of addresses
	 *
	 * @param \Nocks\SDK\Model\PaymentAddress[] $addressesToValidate
	 *
	 * @return PaymentAddressValidationResult
	 * @throws \Nocks\SDK\Exception\BadRequestException
	 * @throws \Nocks\SDK\Exception\ForbiddenException
	 * @throws \Nocks\SDK\Exception\GoneException
	 * @throws \Nocks\SDK\Exception\InternalServerError
	 * @throws \Nocks\SDK\Exception\MethodNotAllowedException
	 * @throws \Nocks\SDK\Exception\NotAcceptable
	 * @throws \Nocks\SDK\Exception\NotFoundException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function validateArray(array $addressesToValidate) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'POST',
			'data' => ['addresses' => array_map(function($validation) {
				return $this->resourceHelper->getTransformer()->reverseTransform($validation);
			}, $addressesToValidate)],
			'url' => '/validate',
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->resourceHelper->getTransformer()->transform($data);
		});
	}
}