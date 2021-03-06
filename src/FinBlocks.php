<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks;

use FinBlocks\API\ApiEndpoints;
use FinBlocks\Client\HttpClient;
use FinBlocks\Factory\ModelsFactories;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class FinBlocks
{
    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * FinBlocks constructor.
     *
     * @param string      $key     Path to the SSL Certificate Key file
     * @param string      $cert    Path to the SSL Certificate file
     * @param string      $info    Path to the CA Certificate file
     * @param bool        $sandbox Use SANDBOX environment
     * @param string|null $server  Use this parameter to override the FinBlocks Server that the SDK will target
     * @param string|null $logFile Path to the log file where FinBlocks PHP SDK needs to write their logs
     */
    public function __construct(string $key, string $cert, string $info, bool $sandbox = false, string $server = null, string $logFile = null)
    {
        $this->httpClient = new HttpClient($key, $cert, $info, $sandbox, $server, $logFile);
    }

    /**
     * API Endpoints.
     *
     * @return ApiEndpoints
     */
    public function api(): ApiEndpoints
    {
        return new ApiEndpoints($this->httpClient);
    }

    /**
     * Models Factories.
     *
     * @return ModelsFactories
     */
    public function factories(): ModelsFactories
    {
        return new ModelsFactories();
    }
}
