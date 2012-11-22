<?php

namespace RabbitMQ\Management;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;

class HttpClient extends Client
{
    private $hydrator;

    public function getHydrator()
    {
        if (!$this->hydrator) {
            $this->hydrator = new Hydrator();
        }

        return $this->hydrator;
    }

    /**
     * Factory method to create the HttpClient
     *
     * The following array keys and values are available options:
     * - url     : Base URL of web service
     * - port    : Port of web service
     * - scheme  : URI scheme: http or https
     * - username: API username
     * - password: API password
     *
     * @param array|Collection $config Configuration data
     *
     * @return self
     */
    public static function factory($config = array())
    {
        $default = array(
            'base_url' => '{scheme}://{username}:{password}@{url}:{port}',
            'scheme'   => 'http',
            'username' => 'guest',
            'password' => 'guest',
            'port'     => '55672',
        );

        $required = array('port', 'url', 'username', 'password');
        $config = Collection::fromConfig($config, $default, $required);

        $client = new self($config->get('base_url'), $config);

        return $client;
    }
}