<?php

namespace FinBlocks\Tests\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Pagination;
use FinBlocks\Model;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
class CardsPaginationTest extends TestCase
{
    public function testCreateEmptyModelCardsPagination()
    {
        $model = Pagination\CardsPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getEmbedded());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getEmbedded());
    }

    public function testCreateEmptyModelCardsPaginationFromPayload()
    {
        $model = Pagination\CardsPagination::createFromPayload('{
            "total": 0,
            "_links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "_embedded": [
                {
                    "id": "string",
                    "accountHolderId": "string",
                    "label": "string",
                    "tag": "string",
                    "lastFour": "string",
                    "status": "pending",
                    "createdAt": "2019-01-03T17:01:16.982Z",
                    "expiresAt": "2019-01-03T17:01:16.982Z"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getEmbedded());

        $this->assertInstanceOf(Model\Card\Card::class, $model->getEmbedded()[0]);
    }
}
