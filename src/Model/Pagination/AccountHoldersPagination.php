<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Pagination;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\AccountHolder\AbstractAccountHolder;
use FinBlocks\Model\AccountHolder\AccountHolderBusiness;
use FinBlocks\Model\AccountHolder\AccountHolderIndividual;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
final class AccountHoldersPagination extends AbstractPagination
{
    /**
     * @param string|null $jsonData
     */
    protected function __construct(string $jsonData = null)
    {
        parent::__construct($jsonData);
    }

    /**
     * {@inheritdoc}
     */
    public static function create()
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload(string $jsonData)
    {
        try {
            $model = new self($jsonData);

            $array = json_decode($jsonData, true);

            foreach ($array['items'] as $arrayModel) {
                if (!array_key_exists('type', $arrayModel)) {
                    throw new \RuntimeException('Unable to retrieve the type of account holder');
                }

                switch ($arrayModel['type']) {
                    case AccountHolderIndividual::TYPE:
                        $itemModel = AccountHolderIndividual::createFromPayload(json_encode($arrayModel));
                        break;
                    case AccountHolderBusiness::TYPE:
                        $itemModel = AccountHolderBusiness::createFromPayload(json_encode($arrayModel));
                        break;
                    default:
                        throw new \RuntimeException('Invalid account holder\'s type');
                }

                array_push($model->items, $itemModel);
            }

            return $model;
        } catch (\Throwable $throwable) {
            throw new FinBlocksException($throwable->getMessage(), $throwable->getCode(), $throwable);
        }
    }

    /**
     * @return AbstractAccountHolder[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
