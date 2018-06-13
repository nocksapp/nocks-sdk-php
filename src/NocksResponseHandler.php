<?php


namespace Nocks\SDK;


use Nocks\SDK\Exception\BadRequestException;
use Nocks\SDK\Exception\ForbiddenException;
use Nocks\SDK\Exception\GoneException;
use Nocks\SDK\Exception\InternalServerError;
use Nocks\SDK\Exception\MethodNotAllowedException;
use Nocks\SDK\Exception\NotAcceptable;
use Nocks\SDK\Exception\NotFoundException;
use Nocks\SDK\Exception\ServiceUnavailable;
use Nocks\SDK\Exception\TooManyRequests;
use Nocks\SDK\Exception\UnauthorizedException;
use Nocks\SDK\Http\ResponseInterface;
use Nocks\SDK\Transformer\PaginationTransformer;

class NocksResponseHandler {

	/**
	 * @param ResponseInterface $response
	 * @param callable $formatData
	 *
	 * @return mixed
	 *
	 * @throws BadRequestException
	 * @throws UnauthorizedException
	 * @throws ForbiddenException
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @throws NotAcceptable
	 * @throws GoneException
	 * @throws TooManyRequests
	 * @throws InternalServerError
	 * @throws ServiceUnavailable
	 */
	public function handle(ResponseInterface $response, callable $formatData = null) {
		$body = $response->getBody();

		if ($response->isSuccessful()) {
			$data = isset($body['data']) ? $body['data'] : $body;
			$formattedData = $formatData === null ? $data : call_user_func($formatData, $data);

			$pagination = isset($body['meta']) && isset($body['meta']['pagination']) ?
				PaginationTransformer::transform($body['meta']['pagination']) : null;

			if ($pagination || is_array($formattedData)) {
				return new NocksResponse($formattedData, $pagination);
			}

			return $formattedData;
		}

		$message = is_array($body['error']) ? $body['error']['message'] : $body['message'];
		$errorCode = is_array($body['error']) ? $body['error']['code'] : $body['error'];

		switch ($response->getStatusCode()) {
			case 400:
				throw new BadRequestException($message, $response->getStatusCode(), $errorCode);
			case 401:
				throw new UnauthorizedException($message, $response->getStatusCode(), $errorCode);
			case 403:
				throw new ForbiddenException($message, $response->getStatusCode(), $errorCode);
			case 404:
				throw new NotFoundException($message, $response->getStatusCode(), $errorCode);
			case 405:
				throw new MethodNotAllowedException($message, $response->getStatusCode(), $errorCode);
			case 406:
				throw new NotAcceptable($message, $response->getStatusCode(), $errorCode);
			case 410:
				throw new GoneException($message, $response->getStatusCode(), $errorCode);
			case 429:
				throw new TooManyRequests($message, $response->getStatusCode(), $errorCode);
			case 500:
				throw new InternalServerError($message, $response->getStatusCode(), $errorCode);
			case 503:
				throw new ServiceUnavailable($message, $response->getStatusCode(), $errorCode);
			default:
				throw new InternalServerError($message, $response->getStatusCode(), $errorCode);
		}
	}
}