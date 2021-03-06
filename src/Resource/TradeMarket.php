<?php


namespace Nocks\SDK\Resource;


use Nocks\SDK\Generated\TradeMarketResponse;
use Nocks\SDK\Model\TradeMarketBook;
use Nocks\SDK\Model\TradeMarketCandle;
use Nocks\SDK\Model\TradeMarketDistribution;
use Nocks\SDK\Model\TradeMarketHistory;
use Nocks\SDK\Model\TradeMarketQuote;
use Nocks\SDK\Transformer\Transformer;

class TradeMarket {

	private $resourceHelper;

	private $bookTransformer;
	private $historyTransformer;
	private $distributionTransformer;
	private $candlesTransformer;
	private $quoteTransformer;

	public function __construct(ResourceHelper $resourceHelper, Transformer $bookTransformer,
		Transformer $historyTransformer, Transformer $distributionTransformer, Transformer $candlesTransformer,
		Transformer $quoteTransformer) {
		$this->resourceHelper = $resourceHelper;

		$this->bookTransformer = $bookTransformer;
		$this->historyTransformer = $historyTransformer;
		$this->distributionTransformer = $distributionTransformer;
		$this->candlesTransformer = $candlesTransformer;
		$this->quoteTransformer = $quoteTransformer;
	}

	/**
	 * Find TradeMarket
	 *
	 * @param array $queryParameters
	 *
	 * @return TradeMarketResponse
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
	public function find(array $queryParameters = []) {
		return $this->resourceHelper->find($queryParameters);
	}

	/**
	 * Find TradeMarket by code
	 *
	 * @param $code
	 *
	 * @return \Nocks\SDK\Model\TradeMarket
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
	public function findOne($code) {
		return $this->resourceHelper->findOne($code);
	}

	/**
	 * Get the TradeMarket order book
	 *
	 * @param $key
	 *
	 * @return TradeMarketBook
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
	public function book($key) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'url' => '/' . $key . '/book',
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->bookTransformer->transform($data);
		});
	}

	/**
	 * Get the TradeMarket history
	 *
	 * @param $key
	 *
	 * @return TradeMarketHistory[]
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
	public function history($key) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'url' => '/' . $key . '/history',
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return array_map(function($history) {
				return $this->historyTransformer->transform($history);
			}, $data);
		});
	}

	/**
	 * Get the TradeMarket distribution
	 *
	 * @param $key
	 * @param $positions
	 *
	 * @return TradeMarketDistribution
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
	public function distribution($key, $positions) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'url' => '/' . $key . '/distribution/' . $positions,
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->distributionTransformer->transform($data);
		});
	}

	/**
	 * Get the TradeMarket candles
	 *
	 * @param $key
	 * @param $start
	 * @param $end
	 * @param $interval
	 *
	 * @return TradeMarketCandle[]
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
	public function candles($key, $start, $end, $interval) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'url' => '/' . $key . '/candles/' . $start . '/' . $end . '/' . $interval,
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return array_map(function($candle) {
				return $this->candlesTransformer->transform($candle);
			}, $data);
		});
	}

	/**
	 * Get the quote
	 *
	 * @param $key
	 * @param $side
	 * @param $value
	 * @param $amountType
	 *
	 * @return TradeMarketQuote
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
	public function quote($key, $side, $value, $amountType = null) {
		$response = $this->resourceHelper->getRequestHandler()->call(array_merge($this->resourceHelper->requestOptions, [
			'url' => '/' . $key . '/quote/' . $side . '/' . $value . ($amountType ? '/' . $amountType : ''),
		]));

		return $this->resourceHelper->getResponseHandler()->handle($response, function($data) {
			return $this->quoteTransformer->transform($data);
		});
	}
}