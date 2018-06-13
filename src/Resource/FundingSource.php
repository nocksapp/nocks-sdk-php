<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Generated\FundingSourceResponse;
use Nocks\SDK\Model;
use Nocks\SDK\Transformer\Transformer;

class FundingSource {

	private $resourceHelper;
	private $paymentTransformer;

	public function __construct(ResourceHelper $resourceHelper, Transformer $paymentTransformer) {
		$this->resourceHelper = $resourceHelper;
		$this->paymentTransformer = $paymentTransformer;
	}

	/**
	 * @param Model\FundingSource $fundingSource
	 * @param $twoFactorCode
	 *
	 * @return Model\Payment
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
	public function create(Model\FundingSource $fundingSource, $twoFactorCode) {
		$this->resourceHelper->checkAuthenticated();

		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'POST',
			'data' => $this->resourceHelper->getTransformer()->reverseTransform($fundingSource),
			'headers' => array_merge($this->resourceHelper->getScope()->getHeaders(), [
				'X-Nocks-2FA' => $twoFactorCode,
			]),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->paymentTransformer->transform($data);
		});
	}

	/**
	 * Find FundingSources
	 *
	 * @param array $queryParameters
	 *
	 * @return FundingSourceResponse
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
	public function find(array $queryParameters = []) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->find($queryParameters);
	}

	/**
	 * Find a single FundingSource
	 *
	 * @param $key
	 *
	 * @return Model\FundingSource
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
	public function findOne($key) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->findOne($key);
	}

	/**
	 * Delete a FundingSource
	 *
	 * @param string uuid
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
	public function delete($uuid) {
		$this->resourceHelper->checkAuthenticated();

		$this->resourceHelper->delete($uuid);
	}
}