<?php
namespace Maras0830\TwitchApi\Core;

class ChannelFeedBack extends Base
{

    public function getPosts($channel, $options, $token = null)
    {
        $defaultOptions = ['limit', 'cursor'];

        $query = [];

        foreach ($defaultOptions as $option) {
            if (isset($options[ $option ])) {
                $query[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders($this->getToken($token));
        $parameters['query'] = $query;

        $response = $this->client->request('GET', '/kraken/feed/'. $channel .'/posts' , $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function putPost($channel, $options, $token = null)
    {
        $defaultOptions = ['content', 'share'];

        $query = [];

        foreach ($defaultOptions as $option) {
            if (isset($options[ $option ])) {
                $channelOptions[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders($this->getToken($token));
        $parameters['query'] = $query;

        $response = $this->client->post('/kraken/feed/'. $channel .'/posts', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function getPost($channel, $post_id, $token)
    {
        $parameters = $this->getDefaultHeaders($this->getToken($token));

        $response = $this->client->post('/kraken/feed/'. $channel .'/posts/'. $post_id, $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function removePost($channel, $post_id, $token)
    {
        $parameters = $this->getDefaultHeaders($this->getToken($token));

        $response = $this->client->delete('/kraken/feed/'. $channel .'/posts/'. $post_id, $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function postPostReaction($channel, $post_id, $options , $token = null)
    {
        $defaultOptions = ['emote_id'];

        $query = [];

        foreach ($defaultOptions as $option) {
            if (isset($options[ $option ])) {
                $query[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders($this->getToken($token));
        $parameters['query'] = $query;

        $response = $this->client->post('/kraken/feed/'. $channel .'/posts/'. $post_id .'reactions', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    public function removePostReaction($channel, $post_id, $options , $token = null)
    {
        $defaultOptions = ['emote_id'];

        $query = [];

        foreach ($defaultOptions as $option) {
            if (isset($options[ $option ])) {
                $query[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders($this->getToken($token));
        $parameters['query'] = $query;

        $response = $this->client->delete('/kraken/feed/'. $channel .'/posts/'. $post_id .'reactions', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }
}