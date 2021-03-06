<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\AccountHolder;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Address\Address;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class AccountHolderIndividual extends AbstractAccountHolder
{
    const TYPE = 'individual';

    /**
     * AccountHolderIndividual constructor.
     *
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct();

        if (!empty($jsonData)) {
            try {
                $arrayData = json_decode($jsonData, true);

                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException(json_last_error_msg(), json_last_error());
                }

                foreach ($arrayData as $property => $content) {
                    switch ($property) {
                        case 'dateOfBirth':
                            $this->$property = !empty($content) ? new \DateTime($content) : $content;
                            break;
                        case 'address':
                            $this->$property = Address::createFromPayload(json_encode($content));
                            break;
                        default:
                            $this->$property = $content;
                    }
                }
            } catch (\Throwable $throwable) {
                throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
            }
        } else {
            $this->setType(self::TYPE);
        }
    }

    /**
     * @return AccountHolderIndividual
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return AccountHolderIndividual
     */
    public static function createFromPayload(string $jsonData)
    {
        return new self($jsonData);
    }
}
