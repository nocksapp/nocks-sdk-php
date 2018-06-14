<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Generated\MerchantProfileResponse;
use Nocks\SDK\Model;
use Nocks\SDK\Model\MerchantProfileTurnover;
use Nocks\SDK\Transformer\Transformer;

class MerchantProfile {

	private $resourceHelper;
	private $turnoverTransformer;

	public function __construct(ResourceHelper $resourceHelper, Transformer $turnoverTransformer) {
		$this->resourceHelper = $resourceHelper;
		$this->turnoverTransformer = $turnoverTransformer;
	}

	/**
	 * Override the baseUrl in the requestOptions
	 *
	 * @param $merchantUuid
	 */
	private function setBaseUrl($merchantUuid) {
		$this->resourceHelper->requestOptions['baseUrl'] = $this->resourceHelper->getScope()->getBaseUrl() .
		                                                   'merchant/' . $merchantUuid . '/merchant-profile';
	}

	/**
	 * Create a new MerchantProfile
	 *
	 * @param $merchantUuid
	 * @param Model\MerchantProfile $merchantProfile
	 *
	 * @return Model\MerchantProfile
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
	public function create($merchantUuid, Model\MerchantProfile $merchantProfile) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($merchantUuid);

		return $this->resourceHelper->create($merchantProfile);
	}

	/**
	 * Find MerchantProfiles
	 *
	 * @param $merchantUuid
	 * @param array $queryParameters
	 *
	 * @return MerchantProfileResponse
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
	public function find($merchantUuid, array $queryParameters = []) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($merchantUuid);

		return $this->resourceHelper->find($queryParameters);
	}

	/**
	 * Find a single MerchantProfile
	 *
	 * @param $merchantUuid
	 * @param $uuid
	 *
	 * @return Model\MerchantProfile
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
	public function findOne($merchantUuid, $uuid) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($merchantUuid);

		return $this->resourceHelper->findOne($uuid);
	}

	/**
	 * Delete a MerchantProfile
	 *
	 * @param $merchantUuid
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
	public function delete($merchantUuid, $uuid) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($merchantUuid);

		$this->resourceHelper->delete($uuid);
	}

	/**
	 * Create a turnover for a MerchantProfile
	 *
	 * @param $merchantUuid
	 * @param $uuid
	 *
	 * @param MerchantProfileTurnover $merchantProfileTurnover
	 *
	 * @return MerchantProfileTurnover
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
	public function turnover($merchantUuid, $uuid, MerchantProfileTurnover $merchantProfileTurnover) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($merchantUuid);

		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'POST',
			'url' => '/' . $uuid . '/turnover',
			'data' => $this->turnoverTransformer->reverseTransform($merchantProfileTurnover),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->turnoverTransformer->transform($data);
		});
	}
}