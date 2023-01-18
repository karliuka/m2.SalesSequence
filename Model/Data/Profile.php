<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\Data;

use Magento\Framework\Api\AbstractExtensibleObject;
use Faonni\SalesSequence\Api\Data\ProfileExtensionInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Profile data
 */
class Profile extends AbstractExtensibleObject implements ProfileInterface
{
    /**
     * Retrieve profile id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        $id = $this->_get(self::PROFILE_ID);
        if ($id) {
            return (int)$id;
        }
        return null;
    }

    /**
     * Set profile id
     *
     * @param int $profileId
     * @return $this
     */
    public function setId(int $profileId): ProfileInterface
    {
        return $this->setData(self::PROFILE_ID, $profileId);
    }

    /**
     * Retrieve entity type
     *
     * @return string
     */
    public function getEntityType(): string
    {
        return (string)$this->_get(self::ENTITY_TYPE);
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
        return (int)$this->_get(self::STORE_ID);
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
        return (string)$this->_get(self::PREFIX);
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
        return (string)$this->_get(self::SUFFIX);
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
        return (string)$this->_get(self::START_VALUE);
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
        return (string)$this->_get(self::MAX_VALUE);
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
        return (string)$this->_get(self::WARNING_VALUE);
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
        return (string)$this->_get(self::STEP);
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
        return (string)$this->_get(self::PATTERN);
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
        return (int)$this->_get(self::STATUS);
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

    /**
     * Retrieve existing extension attributes object or create a new one
     *
     * @return \Faonni\SalesSequence\Api\Data\ProfileExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * Set an extension attributes object
     *
     * @param \Faonni\SalesSequence\Api\Data\ProfileExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(ProfileExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
