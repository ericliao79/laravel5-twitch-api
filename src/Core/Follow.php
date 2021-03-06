<?php
namespace Maras0830\TwitchApi\Core;

use GuzzleHttp\Client;

/**
 * Class Follow
 * @package Maras0830\TwitchApi\Core
 */
class Follow extends Base
{

    /**
     * Get channel's list of following users.
     *
     * @param $channel
     * @param array $options
     * @return mixed
     */
    public function getFollowsByChannel($channel, $options = [])
    {
        $availableOptions = ['limit', 'offset', 'direction'];

        $query = [];

        foreach ($availableOptions as $option) {
            if (isset($options[ $option ])) {
                $query[ $option ] = $options[ $option ];
            }
        }
        $parameters = $this->getDefaultHeaders();
        $parameters[ 'query' ] = $query;

        $response = $this->client->request('GET', '/kraken/channels/' . $channel . '/follows', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get a user's list of followed channels.
     *
     * @param $user
     * @param array $options
     * @return mixed
     */
    public function getUserFollowsChannel($user, $options = [])
    {
        $availableOptions = ['limit', 'offset', 'direction', 'sortby'];

        $query = [];

        foreach ($availableOptions as $option) {

            if (isset($options[ $option ])) {

                $query[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders();
        $parameters[ 'query' ] = $query;

        $response = $this->client->request('GET', '/kraken/users/' . $user . '/follows/channels', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get infomation of follow relationship between user and target channel.
     *
     * @param $user
     * @param $channel
     * @return mixed
     */
    public function getUserFollowsChannelStatus($user, $channel)
    {
        $parameters = $this->getDefaultHeaders();

        $response = $this->client->request('GET', '/kraken/users/' . $user . '/follows/channels/' . $channel, $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Adds User to :target's followers. :user is the authenticated user's name and :target is the name of the channel to be followed.
     *
     * @required scope: user_follows_edit
     *
     * @param $user
     * @param $channel
     * @param null $options
     * @param null $token
     * @return mixed
     * @throws \Maras0830\TwitchApi\Exceptions\AuthenticationException
     */
    public function putAuthenticatedUserToFollowChannel($user, $channel, $options = null, $token = null)
    {
        $token = $this->getToken($token);

        $defaultOptions = ['notifications'];

        $channelOptions = [];

        foreach ($defaultOptions as $option) {
            if (isset($options[ $option ])) {
                $channelOptions[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders($token);

        $parameters['headers']['Content-type'] = ['application/json'];
        $parameters['body'] = $channelOptions;

        $response = $this->client->put('/users/' . $user . '/follows/channels/' . $channel, $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Removes user from :target's followers. :user is the authenticated user's name and :target is the name of the channel to be unfollowed.
     *
     * @required scope: user_follows_edit
     *
     * @param $user
     * @param $channel
     * @param null $token
     * @return bool
     * @throws \Maras0830\TwitchApi\Exceptions\AuthenticationException
     */
    public function deleteAuthenticatedUserToUnFollowChannel($user, $channel, $token = null)
    {
        $token = $this->getToken($token);

        $parameters = $this->getDefaultHeaders($token);

        $response = $this->client->delete('/kraken/users/' . $user . '/follows/channels/' . $channel, $parameters);

        if ($response->getStatusCode() == 204)
            return true;
        else
            return false;
    }
}