<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model;
use FinBlocks\Model\Pagination;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class TransfersPaginationTest extends TestCase
{
    public function testCreateEmptyModelTransfersPagination()
    {
        $model = Pagination\TransfersPagination::create();

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertInternalType('string', $model->getLinks()->getSelf());
        $this->assertInternalType('string', $model->getLinks()->getFirst());
        $this->assertInternalType('string', $model->getLinks()->getPrev());
        $this->assertInternalType('string', $model->getLinks()->getNext());
        $this->assertInternalType('string', $model->getLinks()->getLast());

        $this->assertInternalType('integer', $model->getTotal());
        $this->assertInternalType('array', $model->getItems());

        $this->assertEquals(0, $model->getTotal());
        $this->assertEquals([], $model->getItems());
    }

    public function testCreateModelTransfersPaginationFromPayload()
    {
        $model = Pagination\TransfersPagination::createFromPayload('{
            "total": 0,
            "links": {
                "self": "string",
                "first": "string",
                "prev": "string",
                "next": "string",
                "last": "string"
            },
            "items": [
                {
                    "id": "string",
                    "status": "string",
                    "nature": "transfer",
                    "label": "string",
                    "tag": "string",
                    "from": "string",
                    "to": "string",
                    "debitedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "creditedAmount": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "fees": {
                        "currency": "GBP",
                        "amount": 0
                    },
                    "createdAt": "2019-01-03T16:52:15.220Z",
                    "executedAt": "2019-01-03T16:52:15.220Z"
                }
            ]
        }');

        $this->assertInstanceOf(Pagination\Links::class, $model->getLinks());

        $this->assertCount(1, $model->getItems());

        $this->assertInstanceOf(Model\Transfer\Transfer::class, $model->getItems()[0]);
    }

    public function testCreateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\TransfersPagination::create();
        $model->httpCreate();
    }

    public function testUpdateArray()
    {
        $this->expectException(FinBlocksException::class);

        $model = Pagination\TransfersPagination::create();
        $model->httpUpdate();
    }

    public function testCreateFilledModelFromWrongJsonPayload()
    {
        $this->expectException(FinBlocksException::class);

        Pagination\TransfersPagination::createFromPayload('This is not a JSON payload');
    }
}
