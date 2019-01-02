<?php

namespace FinBlocks\Model\BankAccount\BankAccountDetails;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
final class BankAccountOtherDetails implements BaseModelInterface
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $bic;

    /**
     * @var string
     */
    private $accountNumber;

    /**
     * BankAccountOtherDetails constructor.
     *
     * @param string|null $jsonData
     */
    private function __construct(string $jsonData = null)
    {
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
     * @param string $country
     */
    public function setCountry(string $country)
    {
        Assert::stringNotEmpty($country);
        Assert::length($country, 3);

        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @param string $bic
     */
    public function setBic(string $bic)
    {
        Assert::stringNotEmpty($bic);

        if (!empty($bic)) {
            Assert::lengthBetween($bic, 8, 11);
        }

        $this->bic = $bic;
    }

    /**
     * @return string
     */
    public function getBic(): string
    {
        return $this->bic;
    }

    /**
     * @param string $accountNumber
     */
    public function setAccountNumber(string $accountNumber)
    {
        Assert::stringNotEmpty($accountNumber);
        Assert::length($accountNumber, 20);

        $this->accountNumber = $accountNumber;
    }

    /**
     * @return string
     */
    public function getAccountNumber(): string
    {
        return $this->accountNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'country' => $this->country,
            'bic' => $this->bic,
            'accountNumber' => $this->accountNumber,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Bank Account details');
    }
}