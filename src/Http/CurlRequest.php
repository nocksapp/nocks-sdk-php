<?php


namespace Nocks\SDK\Http;


class CurlRequest implements RequestInterface {

	/**
	 * @param array $options
	 *
	 * @return mixed|string
	 */
	private function buildUrlFromOptions(array $options) {
		$baseUrl = isset($options['baseUrl']) ? $options['baseUrl'] : '';
		$url = isset($options['url']) ? $options['url'] : '';

		return $baseUrl . $url;
	}

	/**
	 * @param array $options
	 *
	 * @return mixed|string
	 */
	private function getMethodFromOptions(array $options) {
		if (isset($options['method']) && in_array($options['method'], ['GET', 'POST', 'PUT', 'DELETE'])) {
			return $options['method'];
		}

		return 'GET'; // Default to GET
	}

	/**
	 * @param array $options
	 *
	 * @return array|mixed
	 */
	private function getHeadersFromOptions(array $options) {
		if (isset($options['headers'])) {
			if (is_array($options['headers'])) {
				return array_map(function($key, $value) {
					return $key . ': ' . $value;
				}, array_keys($options['headers']), array_values($options['headers']));
			}

			return $options['headers'];
		}

		return [];
	}

	/**
	 * Perform a Http request
	 *
	 * @param array $options
	 *
	 * @return Response
	 */
	public function call(array $options) {
		$url = $this->buildUrlFromOptions($options);
		$method = $this->getMethodFromOptions($options);
		$headers = $this->getHeadersFromOptions($options);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);

		if (in_array($method, ['POST', 'PUT'])) {
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(isset($options['data']) ? $options['data'] : []));
		}

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$response = curl_exec($ch);
		$httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		curl_close($ch);

		return new Response($httpStatusCode, $response);
	}

}