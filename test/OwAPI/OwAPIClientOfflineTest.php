<?php

namespace OwAPI;

use PHPUnit\Framework\TestCase;

class OwAPIClientOfflineTest extends TestCase
{
    private $testPlatform = 'pc';
    private $testRegion   = 'eu';
    private $testBattletag = 'Ori-21337';

    public function assertUrl($url, $response)
    {
        $baseUri = $response->getRequest()->getConfig()['base_uri'];

        $this->assertEquals(
            'https://ow-api.com/v1' . $url,
            $baseUri->getScheme() . '://' . $baseUri->getHost() . $baseUri->getPath()
            . $response->getRequest()->getUrl()
        );
    }

    public function assertGetBody($expected, $keyName, $response)
    {
        $this->assertEquals($expected, $response->getBody()[$keyName]);
    }

    public function assertStatusCode($expected, $response)
    {
        $this->assertEquals($expected, $response->getStatus());
    }

    public function assertUserAgent($expected, $response)
    {
        $this->assertEquals($expected, $response->getRequest()->getConfig()['headers']['User-Agent']);
    }

    public function testProfile()
    {
        $client   = new Client(false);
        $response = $client->profile($this->testPlatform, $this->testRegion, $this->testBattletag);

        $this->assertUrl(
            '/stats/' . $this->testPlatform . '/' . $this->testRegion . '/' . $this->testBattletag . '/profile',
            $response
        );
        $this->assertUserAgent('ow-api-php/' . phpversion() . '/1.0', $response);
        $this->assertStatusCode('', $response);
        $this->assertGetBody('', 'name', $response);
    }

    public function testCompleteStats()
    {
        $client   = new Client(false);
        $response = $client->completeStats($this->testPlatform, $this->testRegion, $this->testBattletag);

        $this->assertUrl(
            '/stats/' . $this->testPlatform . '/' . $this->testRegion . '/' . $this->testBattletag . '/complete',
            $response
        );
        $this->assertUserAgent('ow-api-php/' . phpversion() . '/1.0', $response);
        $this->assertStatusCode('', $response);
        $this->assertGetBody('', 'name', $response);
    }

    public function testHeroes()
    {
        $client   = new Client(false);
        $response = $client->heroes($this->testPlatform, $this->testRegion, $this->testBattletag, ['mercy', 'brigitte']);

        $this->assertUrl(
            '/stats/' . $this->testPlatform . '/' . $this->testRegion . '/' . $this->testBattletag . '/heroes/mercy,brigitte',
            $response
        );
        $this->assertUserAgent('ow-api-php/' . phpversion() . '/1.0', $response);
        $this->assertStatusCode('', $response);
        $this->assertGetBody('', 'name', $response);
    }
}
