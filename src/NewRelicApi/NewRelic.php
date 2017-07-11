<?php
/**
 * NewRelic.php
 */

namespace NewRelicApi;

use GuzzleHttp\Client as GuzzleClient;
use InvalidArgumentException;

/**
 * Wrapper for general
 *
 * @package    NewRelicApi
 * @author     Tim Diels <info@tim-diels.bee>
 * @version    $Id$
 */
class Newrelic {
  /**
   * @var string
   */
  private $baseUrl;

  /**
   * @var string
   */
  private $apiKey;

  /**
   * @param string $baseUrl
   * @param string $apiKey
   */
  public function __construct($baseUrl, $apiKey = '') {
    $this->baseUrl = $baseUrl;
    $this->apiKey = $apiKey;
  }

  /**
   * Create a request to NewRelic.
   *
   * @param $url
   * @param string $method
   * @param array $data
   * @return mixed
   */
  public function buildRequest($url = '', $method = 'GET', array $data = [])
  {
    if ($method != 'GET') {
      throw new InvalidArgumentException('New Relic api method must be "GET" (for now)');
    }

    $guzzle = new GuzzleClient(['base_uri' => $this->baseUrl]);
    $params = ['headers' => ['X-Api-Key' => $this->apiKey]];

    // Allow to send parameters with the request.
    if (count($data)) {
      $params['form_params'] = $data;
    }

    $response = $guzzle->get($url, $params)->getBody();

    return json_decode($response);
  }

  /**
   * Check if NewRelic is available
   *
   * @return bool
   */
  public function isAvailable() {

    if ($this->buildRequest('servers.json')) {
      return true;
    }

    return false;
  }

  /**
   * Get a list of servers.
   * @param array $data
   * @return mixed
   */
  public function getServers(array $data = []) {
    return $this->buildRequest('servers.json', 'GET', $data);
  }
}
