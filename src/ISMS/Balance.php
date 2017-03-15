<?php

namespace ISMS;

use GuzzleHttp;

class Balance
{
    const API_URL = 'https://www.isms.com.my/isms_balance.php';

    protected $credentials;

    public function __construct($username, $password)
    {
        $this->credentials = ['un' => $username, 'pwd' => $password];
    }

    public function get()
    {
        $client = new GuzzleHttp\Client;

        $response = $client->request('get', self::API_URL, ['query' => $this->credentials]);

        $response_content = $response->getBody()->getContents();

        if (strpos($response_content, '=') === false)
            return $response_content;

        list ($response_code, $response_description) = $this->parse_response($response_content);

        if ($response_code != 2000)
            throw new \Exception(sprintf('%s: %s', $response_code, $response_description), (int) $response_code);
    }

    protected function parse_response($response)
    {
        list ($code, $description) = explode('=', $response);

        return [$code, trim($description)];
    }
}