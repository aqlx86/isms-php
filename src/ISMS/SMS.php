<?php

namespace ISMS;

use ISMS\Message;
use ISMS\Recipient;

use GuzzleHttp;

class SMS
{
    const API_URL = 'https://www.isms.com.my/isms_send.php';

    protected $credentials;

    protected $messaage;

    public function __construct($username, $password, Message $messaage)
    {
        $this->credentials = ['un' => $username, 'pwd' => $password];
        $this->messaage = $messaage;
    }

    public function send()
    {
        $client = new GuzzleHttp\Client;

        $response = $client->request('get', self::API_URL, ['query' => $this->build_params()]);

        $body = $response->getBody();

        list ($response_code, $response_description) = $this->parse_response($body->getContents());

        if ($response_code != 2000)
            throw new \Exception(sprintf('%s: %s', $response_code, $response_description), (int) $response_code);
    }

    protected function build_params()
    {
        $params = $this->messaage->to_array();

        return array_merge($this->credentials, $params);
    }

    protected function parse_response($response)
    {
        list ($code, $description) = explode('=', $response);

        return [$code, trim($description)];
    }
}