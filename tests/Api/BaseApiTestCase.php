<?php

declare(strict_types=1);

namespace Tests\Api;

use App\Kernel\Application;
use PHPUnit\Framework\TestCase;

abstract class BaseApiTestCase extends TestCase
{
    /**
     * @var Application
     */
    protected $app;

    public function setUp(): void
    {
        $this->app = new Application();

        parent::setUp();
    }

    /**
     * @param string $method
     * @param string $uri
     *
     * @return string
     */
    protected function apiCall(string $method, string $uri): string
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;

        ob_start();

        $this->app->run();

        $result = ob_get_contents();

        ob_end_clean();

        return $result;
    }

    /**
     * @param $uri
     *
     * @return string
     */
    protected function get($uri): string
    {
        return $this->apiCall('GET', $uri);
    }

    /**
     * @param $uri
     * @param $data
     * @return string
     */
    protected function post($uri, $data)
    {
        return $this->apiCall('POST', $uri);
    }
}