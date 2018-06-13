<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Generated\MerchantInvoiceResponse;

class MerchantInvoice {

	private $resourceHelper;

	public function __construct(ResourceHelper $resourceHelper) {
		$this->resourceHelper = $resourceHelper;
	}

	/**
	 * Override the baseUrl in the requestOptions
	 *
	 * @param $merchantUuid
	 */
	private function setBaseUrl($merchantUuid) {
		$this->resourceHelper->requestOptions['baseUrl'] = $this->resourceHelper->getScope()->getBaseUrl() .
		                                                   'merchant/' . $merchantUuid . '/merchant-invoice';
	}

	/**
	 * Find MerchantInvoices
	 *
	 * @param $merchantUuid
	 * @param int $page
	 *
	 * @return MerchantInvoiceResponse
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
	public function find($merchantUuid, $page = 1) {
		$this->resourceHelper->checkAuthenticated();
		$this->setBaseUrl($merchantUuid);

		return $this->resourceHelper->find($page);
	}

	/**
	 * Find a single MerchantInvoice
	 *
	 * @param $merchantUuid
	 * @param $uuid
	 *
	 * @return \Nocks\SDK\Model\MerchantInvoice
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
}