<?php
namespace Maras0830\TwitchApi\Core;


class Users extends Base
{

    /**
     * Returns a user object.
     *
     * @param $username
     * @return mixed
     */
    public function user($username)
    {
        $parameters = $this->getDefaultHeaders($token);

        $user = $this->client->request('GET', '/kraken/users/' . $username, $parameters);

        return json_decode($user->getBody()->getContents());
    }

    /**
     * Returns a user object.
     *
     * @required scope: user_read
     *
     * @param null $token
     * @return mixed
     */
    public function authenticatedUser($token = null)
    {
        $token = $this->getToken($token);

        $parameters = $this->getDefaultHeaders($token);

        $response = $this->client->request('GET', '/kraken/user', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Returns a list of stream objects that the authenticated user is following.
     *
     * @required scope: user_read
     *
     * @param null $token
     * @return mixed
     * @throws \Maras0830\TwitchApi\Exceptions\AuthenticationException
     */
    public function streamsFollowed($token = null)
    {
        $token = $this->getToken($token);

        $parameters = $this->getDefaultHeaders($token);

        $response = $this->client->request('GET', '/kraken/streams/followed', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Returns a list of video objects from channels that the authenticated user is following.
     *
     * @required scope: user_read
     *
     * @param null $token
     *
     * @return mixed
     * @throws \Maras0830\TwitchApi\Exceptions\AuthenticationException
     */
    public function videosFollowed($token = null)
    {
        $token = $this->getToken($token);

        $parameters = $this->getDefaultHeaders($token);

        $response = $this->client->request('GET', '/kraken/videos/followed', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }
}