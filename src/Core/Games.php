<?php
namespace Maras0830\TwitchApi\Core;

/**
 * Class Games
 * @package Maras0830\TwitchApi\Core
 */
class Games extends Base
{

    /**
     * Get games by number of viewers.
     *
     * @return mixed
     */
    public function topGames($options = [])
    {
        $availableOptions = ['limit', 'offset'];
        
        $query = [];

        foreach ($availableOptions as $option) {
            if (isset($options[ $option ])) {
                $query[ $option ] = $options[ $option ];
            }
        }
        
        $parameters = $this->getDefaultHeaders();
        $parameters[ 'query' ] = $query;
        $response = $this->client->request('GET', '/kraken/games/top', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }
}
