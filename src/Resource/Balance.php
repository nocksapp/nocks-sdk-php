<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Generated\BalanceResponse;
use Nocks\SDK\Model;
use Nocks\SDK\Transformer\Transformer;

class Balance {

	private $resourceHelper;
	private $balanceTransferTransformer;

	public function __construct(ResourceHelper $resourceHelper, Transformer $balanceTransferTransformer) {
		$this->resourceHelper = $resourceHelper;
		$this->balanceTransferTransformer = $balanceTransferTransformer;
	}

	/**
	 * Create a balance
	 *
	 * @param Model\Balance $balance
	 *
	 * @return mixed
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
	public function create(Model\Balance $balance) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->create($balance);
	}

	/**
	 * Find all the balances
	 *
	 * @param array $queryParameters
	 *
	 * @return BalanceResponse
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
	 * Find the balance of a single currency
	 *
	 * @param $currency
	 *
	 * @return \Nocks\SDK\Model\Balance
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
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 */
	public function findOne($currency) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->findOne($currency);
	}

	/**
	 * Transfer balance
	 *
	 * @param Model\BalanceTransfer $balanceTransfer
	 *
	 * @return mixed
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
	public function transfer(Model\BalanceTransfer $balanceTransfer) {
		$this->resourceHelper->checkAuthenticated();

		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'POST',
			'url' => '/transfer',
			'data' => $this->balanceTransferTransformer->reverseTransform($balanceTransfer),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->balanceTransferTransformer->transform($data);
		});
	}
}