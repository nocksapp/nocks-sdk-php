<?PHP

namespace Nocks\SDK\Connection;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Message\RequestInterface;
use GuzzleHttp\Message\ResponseInterface;
use GuzzleHttp\Stream\Stream;

/**
 * Class RestClient
 * @package Nocks\SDK\Connection
 */
class RestClient {

    /**
     * @var Guzzle
     */
    protected $guzzle;

    public function __construct($apiEndpoint) {
        $this->guzzle = new Guzzle(array(
            'base_url' => $apiEndpoint,
            'defaults' => array(
                'headers' => array(
                    'Accept' => '*/*'
                ),
                'debug' => false
            )
        ));
    }

    /**
     * @return Guzzle
     */
    public function getGuzzleClient() {
        return $this->guzzle;
    }

    /**
     * enable CURL debugging output
     *
     * @param   bool        $debug
     */
    public function setCurlDebugging($debug = true) {
        $this->guzzle->setDefaultOption('debug', $debug);
    }

    /**
     * enable verbose errors
     *
     * @param   bool        $verboseErrors
     */
    public function setVerboseErrors($verboseErrors = true) {
        $this->verboseErrors = $verboseErrors;
    }

    /**
     * set cURL default option on Guzzle client
     * @param string    $key
     * @param bool      $value
     */
    public function setCurlDefaultOption($key, $value) {
        $this->guzzle->setDefaultOption($key, $value);
    }

    /**
     * set the proxy config for Guzzle
     *
     * @param   $proxy
     */
    public function setProxy($proxy) {
        $this->guzzle->setDefaultOption('proxy', $proxy);
    }

    /**
     * @param   string          $endpointUrl
     * @param   array           $queryString
     * @param   string          $auth           http-signatures to enable http-signature signing
     * @param   float           $timeout        timeout in seconds
     * @return  Response
     */
    public function get($endpointUrl, $queryString = null, $auth = null, $timeout = null) {
        return $this->request('GET', $endpointUrl, $queryString, null, $auth, null, $timeout);
    }

    /**
     * @param   string          $endpointUrl
     * @param   null            $queryString
     * @param   array|string    $postData
     * @param   string          $auth           http-signatures to enable http-signature signing
     * @param   float           $timeout        timeout in seconds
     * @return  Response
     */
    public function post($endpointUrl, $queryString = null, $postData = '', $auth = null, $timeout = null) {
        return $this->request('POST', $endpointUrl, $queryString, $postData, $auth, null, $timeout);
    }

    /**
     * @param   string          $endpointUrl
     * @param   null            $queryString
     * @param   array|string    $putData
     * @param   string          $auth           http-signatures to enable http-signature signing
     * @param   float           $timeout        timeout in seconds
     * @return  Response
     */
    public function put($endpointUrl, $queryString = null, $putData = '', $auth = null, $timeout = null) {
        return $this->request('PUT', $endpointUrl, $queryString, $putData, $auth, null, $timeout);
    }

    /**
     * @param   string          $endpointUrl
     * @param   null            $queryString
     * @param   array|string    $postData
     * @param   string          $auth           http-signatures to enable http-signature signing
     * @param   float           $timeout        timeout in seconds
     * @return  Response
     */
    public function delete($endpointUrl, $queryString = null, $postData = null, $auth = null, $timeout = null) {
        return $this->request('DELETE', $endpointUrl, $queryString, $postData, $auth, 'url', $timeout);
    }

    /**
     * generic request executor
     *
     * @param   string          $method         GET, POST, PUT, DELETE
     * @param   string          $endpointUrl
     * @param   array           $queryString
     * @param   array|string    $body
     * @param   string          $auth           http-signatures to enable http-signature signing
     * @param   string          $contentMD5Mode body or url
     * @param   float           $timeout        timeout in seconds
     * @return RequestInterface
     */
    public function buildRequest($method, $endpointUrl, $queryString = null, $body = null, $auth = null, $contentMD5Mode = null, $timeout = null) {

        $request = $this->guzzle->createRequest($method, $endpointUrl);

        if ($queryString) {
            $request->getQuery()->replace($queryString);
        }

        if (!is_null($body)) {
            if (!$request->hasHeader('Content-Type')) {
                $request->setHeader('Content-Type', 'application/json');
            }

            if (!is_string($body)) {
                $body = json_encode($body);
            }

            $request->setBody(Stream::factory($body));
        }

        return $request;
    }

    /**
     * generic request executor
     *
     * @param   string          $method         GET, POST, PUT, DELETE
     * @param   string          $endpointUrl
     * @param   array           $queryString
     * @param   array|string    $body
     * @param   string          $auth           http-signatures to enable http-signature signing
     * @param   string          $contentMD5Mode body or url
     * @param   float           $timeout        timeout in seconds
     * @return Response
     */
    public function request($method, $endpointUrl, $queryString = null, $body = null, $auth = null, $contentMD5Mode = null, $timeout = null) {
        $request = $this->buildRequest($method, $endpointUrl, $queryString, $body, $auth, $contentMD5Mode, $timeout);
        $response = $this->guzzle->send($request);

        return $this->responseHandler($response);
    }

    public function responseHandler(ResponseInterface $responseObj) {
        $httpResponseCode = (int)$responseObj->getStatusCode();
        $body = $responseObj->getBody();

        if ($httpResponseCode == 200 || $httpResponseCode == 201) {
            if (!$body) {
                throw new \Exception("Empty response", $httpResponseCode);
            }

            $result = new Response($httpResponseCode, $body);

            return $result;
        } else {
            throw new \Exception("Server Response: " . $body, $httpResponseCode);
        }
    }
}