<?php
namespace Maras0830\TwitchApi\Core;

/**
 * Class Teams
 * @package Maras0830\TwitchApi\Core
 */
class Teams extends Base
{

    /**
     * Returns a list of active teams.
     *
     * @return mixed
     */
    public function teams()
    {
        $parameters = $this->getDefaultHeaders($token);

        $response = $this->client->request('GET', '/kraken/teams', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Returns a team object for :team.
     *
     * @param $team
     * @return mixed
     */
    public function team($team)
    {
        $parameters = $this->getDefaultHeaders($token);

        $response = $this->client->request('GET', '/kraken/teams/' . $team, $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }
}