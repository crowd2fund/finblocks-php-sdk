<?php

/*
 * This file is part of FinBlocks PHP SDK.
 *
 * Copyright (C) 2018 FinBlocks Ltd.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FinBlocks\Model\Deposit;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\Address\Address;
use FinBlocks\Model\BaseModelInterface;
use FinBlocks\Model\Money\Money;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 *
 * @since   1.0.0
 */
abstract class AbstractDeposit implements BaseModelInterface
{
    const NATURE = 'deposit';

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var string
     */
    protected $nature = self::NATURE;

    /**
     * @var string
     */
    private $returnUrl;

    /**
     * @var Address
     */
    protected $billingAddress;

    /**
     * @var string
     */
    protected $to;

    /**
     * @var Money
     */
    protected $amount;

    /**
     * @var Money
     */
    protected $debitedAmount;

    /**
     * @var Money
     */
    protected $creditedAmount;

    /**
     * @var Money
     */
    protected $fees;

    /**
     * @var \DateTime
     */
    protected $createdAt;

    /**
     * @var \DateTime|null
     */
    protected $executedAt;

    /**
     * AbstractDeposit constructor.
     */
    protected function __construct()
    {
        $this->billingAddress = Address::create();
        $this->amount = Money::create();
        $this->debitedAmount = Money::create();
        $this->creditedAmount = Money::create();
        $this->fees = Money::create();
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getNature(): string
    {
        return $this->nature;
    }

    /**
     * @param string $returnUrl
     */
    public function setReturnUrl(string $returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * @return Address
     */
    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    /**
     * @param string $to
     */
    public function setTo(string $to)
    {
        $this->to = $to;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return Money
     */
    public function getDebitedAmount(): Money
    {
        return $this->debitedAmount;
    }

    /**
     * @return Money
     */
    public function getCreditedAmount(): Money
    {
        return $this->creditedAmount;
    }

    /**
     * @return Money
     */
    public function getFees(): Money
    {
        return $this->fees;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return \DateTime|null
     */
    public function getExecutedAt()
    {
        return $this->executedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'returnUrl' => $this->returnUrl,
            'to'        => $this->to,
            'amount'    => $this->amount->httpCreate(),
            'fees'      => $this->fees->httpCreate(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Deposit');
    }
}
