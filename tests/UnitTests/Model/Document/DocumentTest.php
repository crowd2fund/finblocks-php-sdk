<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Finblocks\Tests\UnitTests\Model\Document;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Document\DocumentDrivingLicense;
use FinBlocks\Model\Document\DocumentIdCard;
use FinBlocks\Model\Document\DocumentPassport;
use PHPUnit\Framework\TestCase;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
class DocumentTest extends TestCase
{
    public function testCreateEmptyModelAndSettersForIdCard()
    {
        $model = DocumentIdCard::create();
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayloadForIdCard()
    {
        $model = DocumentIdCard::createFromPayload('{
            "id": "1111",
            "label": "Document\'s Label",
            "tag": "Document\'s Tag",
            "type": "national_identity_card",
            "createdAt": "2019-01-02T12:53:25.835Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('Document\'s Label', $model->getLabel());
        $this->assertEquals('Document\'s Tag', $model->getTag());
        $this->assertEquals(DocumentIdCard::TYPE, $model->getType());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-02 12:53:25', $model->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayloadForIdCard()
    {
        $this->expectException(FinBlocksException::class);

        DocumentIdCard::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForIdCard()
    {
        $model = DocumentIdCard::create();
        $model->setFront('front');
        $model->setBack('back');

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('front', $array);
        $this->assertArrayHasKey('back', $array);
    }

    public function testUpdateArrayForIdCard()
    {
        $this->expectException(FinBlocksException::class);

        $model = DocumentIdCard::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForDrivingLicense()
    {
        $model = DocumentDrivingLicense::create();
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayloadForDrivingLicense()
    {
        $model = DocumentDrivingLicense::createFromPayload('{
            "id": "1111",
            "label": "Document\'s Label",
            "tag": "Document\'s Tag",
            "type": "driving_licence",
            "createdAt": "2019-01-02T12:53:25.835Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('Document\'s Label', $model->getLabel());
        $this->assertEquals('Document\'s Tag', $model->getTag());
        $this->assertEquals(DocumentDrivingLicense::TYPE, $model->getType());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-02 12:53:25', $model->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayloadForDrivingLicense()
    {
        $this->expectException(FinBlocksException::class);

        DocumentDrivingLicense::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForDrivingLicense()
    {
        $model = DocumentDrivingLicense::create();
        $model->setFront('front');
        $model->setBack('back');

        $array = $model->httpCreate();

        $this->assertCount(4, $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('front', $array);
        $this->assertArrayHasKey('back', $array);
    }

    public function testUpdateArrayForDrivingLicense()
    {
        $this->expectException(FinBlocksException::class);

        $model = DocumentDrivingLicense::create();
        $model->httpUpdate();
    }

    public function testCreateEmptyModelAndSettersForPassport()
    {
        $model = DocumentPassport::create();
        $model->setLabel('label');
        $model->setTag('tag');

        $this->assertEquals('label', $model->getLabel());
        $this->assertEquals('tag', $model->getTag());
    }

    public function testCreateFilledModelFromJsonPayloadForPassport()
    {
        $model = DocumentPassport::createFromPayload('{
            "id": "1111",
            "label": "Document\'s Label",
            "tag": "Document\'s Tag",
            "type": "passport",
            "createdAt": "2019-01-02T12:53:25.835Z"
        }');

        $this->assertEquals('1111', $model->getId());
        $this->assertEquals('Document\'s Label', $model->getLabel());
        $this->assertEquals('Document\'s Tag', $model->getTag());
        $this->assertEquals('passport', $model->getType());

        $this->assertInstanceOf(\DateTime::class, $model->getCreatedAt());

        $this->assertEquals('2019-01-02 12:53:25', $model->getCreatedAt()->format('Y-m-d H:i:s'));
    }

    public function testCreateFilledModelFromWrongJsonPayloadForPassport()
    {
        $this->expectException(FinBlocksException::class);

        DocumentPassport::createFromPayload('This is not a JSON payload');
    }

    public function testCreateArrayForPassport()
    {
        $model = DocumentPassport::create();
        $model->setFront('front');

        $array = $model->httpCreate();

        $this->assertCount(3, $array);
        $this->assertArrayHasKey('label', $array);
        $this->assertArrayHasKey('tag', $array);
        $this->assertArrayHasKey('front', $array);
    }

    public function testUpdateArrayForPassport()
    {
        $this->expectException(FinBlocksException::class);

        $model = DocumentPassport::create();
        $model->httpUpdate();
    }
}
