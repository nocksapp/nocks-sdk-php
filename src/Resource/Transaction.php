<?php


namespace Nocks\SDK\Resource;

use Nocks\SDK\Generated\TransactionResponse;
use Nocks\SDK\Model;
use Nocks\SDK\Transformer\Transformer;

class Transaction {

	private $resourceHelper;
	private $quoteTransformer;
	private $statisticTransformer;

	public function __construct(ResourceHelper $resourceHelper, Transformer $quoteTransformer, Transformer $statisticTransformer) {
		$this->resourceHelper = $resourceHelper;
		$this->quoteTransformer = $quoteTransformer;
		$this->statisticTransformer = $statisticTransformer;
	}

	/**
	 * Get the transaction price quote
	 *
	 * @param Model\TransactionQuote $quote
	 *
	 * @return Model\TransactionQuote
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
	public function quote(Model\TransactionQuote $quote) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'method' => 'POST',
			'url' => '/quote',
			'data' => $this->quoteTransformer->reverseTransform($quote),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->quoteTransformer->transform($data);
		});
	}

	/**
	 * @param Model\Transaction $transaction
	 *
	 * @return Model\Transaction
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
	public function create(Model\Transaction $transaction) {
		return $this->resourceHelper->create($transaction);
	}

	/**
	 * @param array $queryParameters
	 *
	 * @return TransactionResponse
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
	 * @param $uuid
	 *
	 * @return Model\Transaction
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

		return $this->resourceHelper->findOne($uuid);
	}

	/**
	 * @param string $uuid
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
	public function cancel($uuid) {
		$this->resourceHelper->checkAuthenticated();

		$this->resourceHelper->delete($uuid);
	}

	/**
	 * @return Model\TransactionStatistic[]
	 *
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
	public function statistics() {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'baseUrl' => $this->resourceHelper->getScope()->getBaseUrl() . 'transaction-statistics',
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->statisticTransformer->transform($data);
		});
	}
}