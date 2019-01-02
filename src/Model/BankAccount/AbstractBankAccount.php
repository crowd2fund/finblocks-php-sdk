<?php

namespace FinBlocks\Model\BankAccount;

use FinBlocks\Exception\FinBlocksException;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountCaDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountGbDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountIbanDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountOtherDetails;
use FinBlocks\Model\BankAccount\BankAccountDetails\BankAccountUsDetails;
use FinBlocks\Model\BaseModelInterface;
use Webmozart\Assert\Assert;

/**
 * @author    David Garcia <me@davidgarcia.cat>
 * @copyright FinBlocks
 *
 * @version 1.0.0
 * @since   1.0.0
 */
abstract class AbstractBankAccount implements BaseModelInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $accountHolderId;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $tag;

    /**
     * @var bool
     */
    private $active;

    /**
     * @var BankAccountCaDetails|BankAccountGbDetails|BankAccountIbanDetails|BankAccountOtherDetails|BankAccountUsDetails
     */
    protected $details;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $type
     */
    protected function setType(string $type)
    {
        Assert::stringNotEmpty($type);
        Assert::oneOf($type, [
            BankAccountGb::TYPE,
            BankAccountIban::TYPE,
            BankAccountCa::TYPE,
            BankAccountUs::TYPE,
            BankAccountOther::TYPE,
        ]);

        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $accountHolderId
     */
    public function setAccountHolderId(string $accountHolderId)
    {
        Assert::stringNotEmpty($accountHolderId);
        Assert::maxLength($accountHolderId, 255);

        $this->accountHolderId = $accountHolderId;
    }

    /**
     * @return string
     */
    public function getAccountHolderId(): string
    {
        return $this->accountHolderId;
    }

    /**
     * @param string|null $label
     */
    public function setLabel(string $label = null)
    {
        Assert::nullOrStringNotEmpty($label);
        Assert::maxLength($label, 255);

        $this->label = $label;
    }

    /**
     * @return string|null
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string|null $tag
     */
    public function setTag(string $tag =  null)
    {
        Assert::nullOrStringNotEmpty($tag);
        Assert::maxLength($tag, 255);

        $this->tag = $tag;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return true  === $this->active;
    }

    /**
     * @param BankAccountCaDetails|BankAccountGbDetails|BankAccountIbanDetails|BankAccountOtherDetails|BankAccountUsDetails $details
     */
    protected function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return BankAccountCaDetails|BankAccountGbDetails|BankAccountIbanDetails|BankAccountOtherDetails|BankAccountUsDetails
     */
    abstract public function getDetails();

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * {@inheritdoc}
     */
    public function httpCreate(): array
    {
        return [
            'accountHolderId' => $this->accountHolderId,
            'label' => $this->label,
            'tag' => $this->tag,
            'details' => $this->details->httpCreate(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function httpUpdate(): array
    {
        throw new FinBlocksException('Impossible to update the Bank Account');
    }
}