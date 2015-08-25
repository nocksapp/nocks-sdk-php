<?PHP

namespace Nocks\SDK\Connection;

use GuzzleHttp\Stream\StreamInterface;

/**
 * Class Response
 * @package Nocks\SDK\Connection
 */
class Response {

    /**
     * @var int
     */
    private $responseCode;

    /**
     * @var \GuzzleHttp\Stream\StreamInterface
     */
    private $responseBody;

    /**
     * @param $responseCode
     * @param StreamInterface $responseBody
     */
    public function __construct($responseCode, StreamInterface $responseBody) {
        $this->responseCode = $responseCode;
        $this->responseBody = $responseBody;
    }

    /**
     * @return int
     */
    public function statusCode() {
        return $this->responseCode;
    }

    /**
     * @return string
     */
    public function body() {
        return (string)$this->responseBody;
    }
}
