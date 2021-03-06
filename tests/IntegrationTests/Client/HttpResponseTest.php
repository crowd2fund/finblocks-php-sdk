<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\IntegrationTests\Client;

use FinBlocks\Client\HttpResponse;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class HttpResponseTest extends TestCase
{
    public function testSuccessfulHttpResponse()
    {
        $httpResponse = new HttpResponse(200, '{"property":"value"}');

        $this->assertEquals(200, $httpResponse->getStatusCode());
        $this->assertEquals('{"property":"value"}', $httpResponse->getBody());
        $this->assertEquals(true, $httpResponse->isSuccessful());
        $this->assertEquals(true, $httpResponse->wasSuccessful());
    }

    public function testUnsuccessfulHttpResponse()
    {
        $httpResponse = new HttpResponse(401, '');

        $this->assertEquals(401, $httpResponse->getStatusCode());
        $this->assertEquals('', $httpResponse->getBody());
        $this->assertEquals(false, $httpResponse->isSuccessful());
        $this->assertEquals(false, $httpResponse->wasSuccessful());
    }
}
