<?php

use NewRelicApi\Newrelic;

class NewRelicTest extends \PHPUnit\Framework\TestCase {

  /**
   * @var string
   */
  protected $baseUrl;

  /**
   * @var string
   */
  protected $apiKey;

  /**
   * {@inheritdoc}
   */
  public function __construct($name = null, array $data = [], $dataName = '')
  {
    $this->baseUrl = getenv('BASE_URL');
    $this->apiKey = getenv('API_KEY');

    parent::__construct($name, $data, $dataName);
  }


  public function testIsAvailable()
  {
    $newrelic = new Newrelic($this->baseUrl, $this->apiKey);
    $this->assertTrue($newrelic->isAvailable(), 'The New Relic API could not be reached.');
  }

  /**
   * @depends testIsAvailable
   */
  public function testGetServers()
  {
    $newrelic = new Newrelic($this->baseUrl, $this->apiKey);
    $this->assertNotEmpty($newrelic->getServers(), 'The data returned is empty.');
  }
}
