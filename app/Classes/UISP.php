<?php

namespace App\Classes;

class UISP {

    protected string $apiKey;
    protected object $user;

    protected \GuzzleHttp\Client $client;

    protected $response;
    protected $result;

    public function __construct()
    {

        $this->client = new \GuzzleHttp\Client([
            'base_url' => 'https://woodrivercontrols.unmsapp.com/nms/api/v2.1/',
            'future' => true
        ]);

        $this->client->setDefaultOption('headers/x-auth-token', env("UISP_API_KEY"));
        $this->client->setDefaultOption('headers/accept', 'application/json');
    }

    public function get(string $uri, array $args = [])
    {
        return $this->request('GET', $uri, $args);
    }

    public function request(string $method, string $uri, array $args = [])
    {
        $this->response = $this->client->get($uri);
        $this->result = $this->response->getBody();

        return $this;
    }

    public function getBody(bool $asJson = true) : object {
        if($asJson) {
            return json_decode($this->result);
        }
        else {
            return $this->result;
        }
    }


}
