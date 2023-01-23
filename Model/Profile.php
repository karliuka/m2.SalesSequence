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
    public function getEntityType()
    {
        return $this->_data[self::ENTITY_TYPE] ?? '';
    }

    /**
     * Set entity type
     *
     * @param string $entityType
     * @return $this
     */
    public function setEntityType($entityType)
    {
        return $this->setData(self::ENTITY_TYPE, $entityType);
    }

    /**
     * Retrieve store id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->_data[self::STORE_ID] ?? '';
    }

    /**
     * Set store id
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Retrieve prefix
     *
     * @return string
     */
    public function getPrefix()
    {
        return $this->_data[self::PREFIX] ?? '';
    }

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix($prefix)
    {
        return $this->setData(self::PREFIX, $prefix);
    }

    /**
     * Retrieve suffix
     *
     * @return string
     */
    public function getSuffix()
    {
        return $this->_data[self::SUFFIX] ?? '';
    }

    /**
     * Set suffix
     *
     * @param string $suffix
     * @return $this
     */
    public function setSuffix($suffix)
    {
        return $this->setData(self::SUFFIX, $suffix);
    }

    /**
     * Retrieve start value
     *
     * @return string
     */
    public function getStartValue()
    {
        return $this->_data[self::START_VALUE] ?? '';
    }

    /**
     * Set start value
     *
     * @param string $startValue
     * @return $this
     */
    public function setStartValue($startValue)
    {
        return $this->setData(self::START_VALUE, $startValue);
    }

    /**
     * Retrieve max value
     *
     * @return string
     */
    public function getMaxValue()
    {
        return $this->_data[self::MAX_VALUE] ?? '';
    }

    /**
     * Set max value
     *
     * @param string $maxValue
     * @return $this
     */
    public function setMaxValue($maxValue)
    {
        return $this->setData(self::MAX_VALUE, $maxValue);
    }

    /**
     * Retrieve warning value
     *
     * @return string
     */
    public function getWarningValue()
    {
        return $this->_data[self::WARNING_VALUE] ?? '';
    }

    /**
     * Set warning value
     *
     * @param string $warningValue
     * @return $this
     */
    public function setWarningValue($warningValue)
    {
        return $this->setData(self::WARNING_VALUE, $warningValue);
    }

    /**
     * Retrieve step
     *
     * @return string
     */
    public function getStep()
    {
        return $this->_data[self::STEP] ?? '';
    }

    /**
     * Set step
     *
     * @param string $step
     * @return $this
     */
    public function setStep($step)
    {
        return $this->setData(self::STEP, $step);
    }

    /**
     * Retrieve pattern
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->_data[self::PATTERN] ?? '';
    }

    /**
     * Set pattern
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern($pattern)
    {
        return $this->setData(self::PATTERN, $pattern);
    }

    /**
     * Whether the profile is active
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->_data[self::STATUS] ?? '';
    }

    /**
     * Set whether the profile is active
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
