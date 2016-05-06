<?phpnamespace Maras0830\TwitchApi\Core;use GuzzleHttp\Client;/** * Class Chat * @package Maras0830\TwitchApi\Core */class Chat extends Base{    /**     * Returns a links object to all other chat endpoints.     *     * @param $channel     * @return mixed     */    public function chatChannel($channel)    {        $response = $this->client->get('kraken/chat/' . $channel);        return $response->json();    }    /**     * Returns a list of all emoticon objects for Twitch.     *     * @param $channel     * @return mixed     */    public function chatBadges($channel)    {        $response = $this->client->get('kraken/chat/' . $channel . '/badges');        return $response->json();    }    /**     * Returns a list of all emoticon objects for Twitch.     *     * @return mixed     */    public function chatEmoticons()    {        $response = $this->client->get('/kraken/chat/emoticons');        return $response->json();    }    /**     * Returns a list of emoticons.     *     * @return mixed     */    public function chatEmoticonImages()    {        $response = $this->client->get('/kraken/chat/emoticon_images');        return $response->json();    }}