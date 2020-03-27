<?php

namespace Asad\ZohoCliq;

use GuzzleHttp\Client as Guzzle;
use RuntimeException;

class ZohoCliq
{
    /**
     * Zoho Cliq Auth Token
     * @var string
     */
    protected $authtoken;

    /**
     * Default send to
     * @var string
     */
    protected $send_to;

    /**
     * Default Channel to send message
     * @var string
     */
    protected $channel;

    /**
     * Zoho Cliq message endpoint
     * @var string
     */
    protected $endpoint;

    /**
     * Zoho Cliq message
     * @var string
     */
    protected $message;

    /**
     * Zoho Cliq card
     * @var string
     */
    protected $card;

    /**
     * The Guzzle HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $guzzle;

    /**
     * Instantiate a new Client.
     *
     * @param string $endpoint
     * @param array $attributes
     * @return void
     */
    public function __construct($authtoken, array $attributes = [], Guzzle $guzzle = null)
    {
        $this->authtoken = $authtoken;

        if (isset($attributes['channel'])) {
            $this->setDefaultChannel($attributes['channel']);
        }

        if (isset($attributes['send_to'])) {
            $this->setDefaultSendTo($attributes['send_to']);
        }

        $this->guzzle = $guzzle ?: new Guzzle;
    }

    /**
     * Set Default AuthToken
     * @param string $authtoken
     * @return void
     */
    public function setAuthToken($authtoken)
    {
        $this->authtoken = $authtoken;
    }

    /**
     * Get Default Authtoken
     * @return string
     */
    public function getAuthToken(): string
    {
        return $this->authtoken;
    }

    /**
     * Set Default SendTo
     * @param string $send_to
     * @return void
     */
    public function setDefaultSendTo($send_to)
    {
        $this->send_to = $send_to;
    }

    /**
     * Get Default Send To
     * @return string
     */
    public function getDefaultSendTo(): string
    {
        return $this->send_to;
    }

    /**
     * Set Default Channel
     * @param string $channel
     * @return void
     */
    public function setDefaultChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * Get Default Channel
     * @return string
     */
    public function getDefaultChannel(): string
    {
        return $this->channel;
    }

    /**
     * Generate Cliq Endpoint from send_to and channel name
     * @return void
     */

    public function generateCliqEndpoint()
    {
        $this->endpoint = "https://cliq.zoho.com/api/v2/" . $this->getDefaultSendTo() . "/" . $this->getDefaultChannel() . "/message";
    }

    /**
     * Get Default Endpoint
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Get Message
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Set Send To onfly
     * @return self
     */

    public function toChannel(): self
    {
        $this->send_to = 'channelsbyname';
        return $this;
    }

    /**
     * Set Send To onfly
     * @return self
     */

    public function toBot(): self
    {
        $this->send_to = 'bots';
        return $this;
    }

    /**
     * Set Send To onfly
     * @return self
     */

    public function toChat(): self
    {
        $this->send_to = 'chats';
        return $this;
    }

    /**
     * Set Send To onfly
     * @return self
     */

    public function toBuddy(): self
    {
        $this->send_to = 'buddies';
        return $this;
    }

    /**
     * Change Channel on fly
     */
    public function to($channel)
    {
        $this->channel = $channel;
        return $this;
    }

    /**
     * Create Message Card
     * @return self
     */
    public function card(array $attributes): self
    {
        $title = isset($attributes['title']) ? $attributes['title'] : "BUG";
        $theme = isset($attributes['theme']) ? $attributes['theme'] : "modern-inline";
        $thumbnail = isset($attributes['thumbnail']) ? $attributes['thumbnail'] : "https://en.gravatar.com/userimage/57826719/1bcf7f90b22897258d2b3e4e84875218.jpg";
        $card = [
            'title' => $title,
            'theme' => $theme,
            'thumbnail' => $thumbnail
        ];
        $this->card = $card;
        return $this;
    }

    /**
     * Send message to selected destination
     * */
    public function send($message)
    {
        $this->message = $message;
        $this->generateCliqEndpoint();
        $payload = $this->createBody($message);
        $encoded = json_encode($payload, JSON_UNESCAPED_UNICODE);

        if ($encoded === false) {
            throw new RuntimeException(sprintf('JSON encoding error %s: %s', json_last_error(), json_last_error_msg()));
        }
        $this->guzzle->post($this->endpoint, [
            'query' => $this->prepareAuth(),
            'body' => $encoded
        ]);
    }

    public function createBody($message)
    {
        if (gettype($this->card) == 'array') {
            $payload['card'] = $this->card;
        }
        $payload['text'] = $message;
        return $payload;
    }

    public function prepareAuth()
    {
        return [
            'authtoken' => $this->getAuthToken()
        ];
    }
}
