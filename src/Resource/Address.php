<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Model\AddressValidation;

class Address {

	private $resourceHelper;

	public function __construct(ResourceHelper $resourceHelper) {
		$this->resourceHelper = $resourceHelper;
	}

	/**
	 * Validate a address
	 *
	 * @param AddressValidation $validation
	 *
	 * @return AddressValidation
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
	public function validate(AddressValidation $validation) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'POST',
			'data' => $this->resourceHelper->getTransformer()->reverseTransform($validation),
			'url' => '/validate',
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->resourceHelper->getTransformer()->transform($data);
		});
	}
}