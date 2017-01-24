<?PHP

namespace Nocks\SDK\Connection;

use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use Psr\Http\Message\ResponseInterface;

/**
 * Class RestClient
 * @package Nocks\SDK\Connection
 */
class RestClient {

    /**
     * @var Guzzle
     */
    protected $guzzle;

    /**
     * @var string
     */
    protected $apiEndpoint;

    /**
     * @var array
     */
    protected $options = [];
    /**
     * @var array
     */
    protected $curlOptions = [];

    public function __construct($apiEndpoint) {
        $this->apiEndpoint = $apiEndpoint;
        $this->guzzle = $this->createGuzzleClient();
    }

    public function createGuzzleClient()
    {
        return new Guzzle(array(
            'base_uri' => $this->apiEndpoint,
            'defaults' => array(
                'debug' => true
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
        $this->options['debug'] = $debug;

        $this->guzzle = $this->createGuzzleClient();
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
        $this->curlOptions[$key] = $value;

        $this->guzzle = $this->createGuzzleClient();
    }

    /**
     * set the proxy config for Guzzle
     *
     * @param   $proxy
     */
    public function setProxy($proxy) {
        $this->options['proxy'] = $proxy;

        $this->guzzle = $this->createGuzzleClient();
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

    private static $replaceQuery = ['=' => '%3D', '&' => '%26'];
    public static function hasQueryValue(Uri $uri, $key) {
        $current = $uri->getQuery();
        $key = strtr($key, self::$replaceQuery);

        if (!$current) {
            $result = [];
        } else {
            $result = [];
            foreach (explode('&', $current) as $part) {
                if (explode('=', $part)[0] === $key) {
                    return true;
                };
            }
        }

        return false;
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
     * @return Request
     */
    public function buildRequest($method, $endpointUrl, $queryString = null, $body = null, $auth = null, $contentMD5Mode = null, $timeout = null) {

        $request = new Request($method, $endpointUrl);

        if (!$request->hasHeader('Accept')) {
            $request = $request->withHeader('Accept', '*/*');
        }

        $uri = $request->getUri();

        if ($queryString) {
            foreach ($queryString as $k => $v) {
                $uri = Uri::withQueryValue($uri, $k, $v);
            }
        }

        // normalize the query string the same way the server expects it
        /** @var Request $request */
        $request = $request->withUri($uri->withQuery($uri->getQuery()));

        if (!is_null($body)) {
            if (!$request->hasHeader('Content-Type')) {
                $request = $request->withHeader('Content-Type', 'application/json');
            }

            if (!is_string($body)) {
                $body = json_encode($body);
            }

            $request = $request->withBody(\GuzzleHttp\Psr7\stream_for($body));
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
        $request = $this->buildRequest($method, $endpointUrl, $queryString, $body, $contentMD5Mode);
        $response = $this->guzzle->send($request, ['auth' => $auth, 'timeout' => $timeout]);

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