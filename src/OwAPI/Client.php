<?php

namespace OwAPI;

/**
 * Class Client
 * @package OwAPI
 */
class Client
{
    const REGIONS = [
        'ASIA' => 'asia',
        'EU'   => 'eu',
        'US'   => 'us',
    ];

    const PLATFORM = [
        'NINTENDO_SWITCH' => 'nintendo_switch',
        'PC'              => 'pc',
        'PLAYSTATION'     => 'psn',
        'XBOX_LIVE'       => 'xbl'
    ];

    private $call;

    public function __construct($call = true)
    {
        $this->call    = $call;
    }

    /**
     * @param string    $platform
     * @param string    $region
     * @param string    $battletag
     * @return Response
     */
    public function profile(string $platform, string $region, string $battletag): Response
    {
        $uri = 'stats/' . $platform
            . '/' . $region
            . '/' . $this->clearBattletag($battletag)
            . '/profile';

        return $this->request($uri);
    }

    /**
     * @param string    $platform
     * @param string    $region
     * @param string    $battletag
     * @return Response
     */
    public function completeStats(string $platform, string $region, string $battletag): Response
    {
        $uri = 'stats/' . $platform
            . '/' . $region
            . '/' . $this->clearBattletag($battletag)
            . '/complete';

        return $this->request($uri);
    }

    /**
     * @param string    $platform
     * @param string    $region
     * @param string    $battletag
     * @param array     $heroes
     * @return Response
     */
    public function heroes(string $platform, string $region, string $battletag, array $heroes): Response
    {
        $uri = 'stats/' . $platform
            . '/' . $region
            . '/' . $this->clearBattletag($battletag)
            . '/heroes/' . implode(',', $heroes)
        ;

        return $this->request($uri);
    }

    private function request($uri) {
        $request = new Request($uri);

        return $request->call($this->call);
    }

    private function clearBattletag(string $battletag): string
    {
        return str_replace('#', '-', $battletag);
    }
}
