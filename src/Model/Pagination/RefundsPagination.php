<?php

namespace FinBlocks\Model\Pagination;

use FinBlocks\Model\Refund\Refund;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class RefundsPagination extends AbstractPagination
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
        return new self($jsonData);
    }

    /**
     * @return Refund[]
     */
    public function getEmbedded(): array
    {
        return $this->_embedded;
    }
}