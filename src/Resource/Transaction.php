<?php


namespace Nocks\SDK\Resource;

use Nocks\SDK\Generated\TransactionResponse;
use Nocks\SDK\Model;
use Nocks\SDK\Transformer\Transformer;

class Transaction {

	private $resourceHelper;
	private $quoteTransformer;

	public function __construct(ResourceHelper $resourceHelper, Transformer $quoteTransformer) {
		$this->resourceHelper = $resourceHelper;
		$this->quoteTransformer = $quoteTransformer;
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
	 * @throws \Nocks\SDK\Exception\ScopeConfigurationException
	 * @throws \Nocks\SDK\Exception\ServiceUnavailable
	 * @throws \Nocks\SDK\Exception\TooManyRequests
	 * @throws \Nocks\SDK\Exception\UnauthorizedException
	 */
	public function create(Model\Transaction $transaction) {
		$this->resourceHelper->checkAuthenticated();

		return $this->resourceHelper->create($transaction);
	}

	/**
	 * @param int $page
	 *
	 * @param null|string $status
	 * @param null|string $merchantProfile
	 * @param null|string $search
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
	public function find($page = 1, $status = null, $merchantProfile = null, $search = null) {
		$this->resourceHelper->checkAuthenticated();

		$queryStringData = ['page' => $page];
		if (!is_null($status)) {
			$queryStringData['status'] = $status;
		}

		if (!is_null($merchantProfile)) {
			$queryStringData['merchant-profile'] = $merchantProfile;
		}

		if (!is_null($search)) {
			$queryStringData['search'] = $search;
		}

		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'url' => '?' . http_build_query($queryStringData),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return array_map(function($transaction) {
				return $this->resourceHelper->getTransformer()->transform($transaction);
			}, $data);
		});
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
}