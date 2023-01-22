<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Magento\Framework\Model\AbstractModel;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Model\ResourceModel\Profile as ProfileResource;

/**
 * Profile model
 */
class Profile extends AbstractModel implements ProfileInterface
{
    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ProfileResource::class);
    }

    /**
     * Retrieve entity type
     *
     * @return string
     */
    public function getEntityType(): string
    {
        return (string)$this->getData(self::ENTITY_TYPE);
    }

    /**
     * Set entity type
     *
     * @param string $entityType
     * @return $this
     */
    public function setEntityType(string $entityType): ProfileInterface
    {
        return $this->setData(self::ENTITY_TYPE, $entityType);
    }

    /**
     * Retrieve store id
     *
     * @return int
     */
    public function getStoreId(): int
    {
        return (int)$this->getData(self::STORE_ID);
    }

    /**
     * Set store id
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId(int $storeId): ProfileInterface
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Retrieve prefix
     *
     * @return string
     */
    public function getPrefix(): string
    {
        return (string)$this->getData(self::PREFIX);
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(string $prefix): ProfileInterface
    {
        return $this->setData(self::PREFIX, $prefix);
    }

    /**
     * Retrieve suffix
     *
     * @return string
     */
    public function getSuffix(): string
    {
        return (string)$this->getData(self::SUFFIX);
    }

    /**
     * Set suffix
     *
     * @param string $suffix
     * @return $this
     */
    public function setSuffix(string $suffix): ProfileInterface
    {
        return $this->setData(self::SUFFIX, $suffix);
    }

    /**
     * Retrieve start value
     *
     * @return string
     */
    public function getStartValue(): string
    {
        return (string)$this->getData(self::START_VALUE);
    }

    /**
     * Set start value
     *
     * @param string $startValue
     * @return $this
     */
    public function setStartValue(string $startValue): ProfileInterface
    {
        return $this->setData(self::START_VALUE, $startValue);
    }

    /**
     * Retrieve max value
     *
     * @return string
     */
    public function getMaxValue(): string
    {
        return (string)$this->getData(self::MAX_VALUE);
    }

    /**
     * Set max value
     *
     * @param string $maxValue
     * @return $this
     */
    public function setMaxValue(string $maxValue): ProfileInterface
    {
        return $this->setData(self::MAX_VALUE, $maxValue);
    }

    /**
     * Retrieve warning value
     *
     * @return string
     */
    public function getWarningValue(): string
    {
        return (string)$this->getData(self::WARNING_VALUE);
    }

    /**
     * Set warning value
     *
     * @param string $warningValue
     * @return $this
     */
    public function setWarningValue(string $warningValue): ProfileInterface
    {
        return $this->setData(self::WARNING_VALUE, $warningValue);
    }

    /**
     * Retrieve step
     *
     * @return string
     */
    public function getStep(): string
    {
        return (string)$this->getData(self::STEP);
    }

    /**
     * Set step
     *
     * @param string $step
     * @return $this
     */
    public function setStep(string $step): ProfileInterface
    {
        return $this->setData(self::STEP, $step);
    }

    /**
     * Retrieve pattern
     *
     * @return string
     */
    public function getPattern(): string
    {
        return (string)$this->getData(self::PATTERN);
    }

    /**
     * Set pattern
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern): ProfileInterface
    {
        return $this->setData(self::PATTERN, $pattern);
    }

    /**
     * Whether the profile is active
     *
     * @return int
     */
    public function getStatus(): int
    {
        return (int)$this->getData(self::STATUS);
    }

    /**
     * Set whether the profile is active
     *
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): ProfileInterface
    {
        return $this->setData(self::STATUS, $status);
    }
}
