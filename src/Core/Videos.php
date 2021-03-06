<?php
namespace Maras0830\TwitchApi\Core;

class Videos extends Base
{

    /**
     * Get video object.
     *
     * @param $id
     * @return mixed
     */
    public function video($id)
    {
        $parameters = $this->getDefaultHeaders();
        
        $response = $this->client->request('GET', '/kraken/videos/' . $id, $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get top videos by number of views,
     *
     * @param array $options
     * @return mixed
     */
    public function getTopVideos($options = [])
    {
        $defaultOptions = ['limit', 'offset', 'game', 'period'];

        $query = [];

        foreach ($defaultOptions as $option) {

            if (isset($options[ $option ])) {

                $query[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders();
        $parameters[ 'query' ] = $query;

        $response = $this->client->request('GET', '/kraken/videos/top', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get list of video objects belonging to channel.
     *
     * @param $channel
     * @param null $options
     * @return mixed
     */
    public function getVideosByChannel($channel, $options = null)
    {
        $defaultOptions = ['limit', 'offset', 'broadcasts', 'hls'];

        $query = [];

        foreach ($defaultOptions as $option) {

            if (isset($options[ $option ])) {

                $query[ $option ] = $options[ $option ];
            }
        }

        $parameters = $this->getDefaultHeaders();
        $parameters[ 'query' ] = $query;

        $response = $this->client->request('GET', '/kraken/channels/' . $channel . '/videos', $parameters);

        return json_decode($response->getBody()->getContents(), true);
    }

}