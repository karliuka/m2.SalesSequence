<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api\Data;

/**
 * Profile data interface
 *
 * @api
 */
interface ProfileInterface
{
    /**
     * Profile id field name
     */
    public const PROFILE_ID = 'profile_id';

    /**
     * Entity type field name
     */
    public const ENTITY_TYPE = 'entity_type';

    /**
     * Store id field name
     */
    public const STORE_ID = 'store_id';

    /**
     * Prefix field name
     */
    public const PREFIX = 'prefix';

    /**
     * Suffix field name
     */
    public const SUFFIX = 'suffix';

    /**
     * Start value field name
     */
    public const START_VALUE = 'start_value';

    /**
     * Max value field name
     */
    public const MAX_VALUE = 'max_value';

    /**
     * Warning value field name
     */
    public const WARNING_VALUE = 'warning_value';

    /**
     * Step field name
     */
    public const STEP = 'step';

    /**
     * Pattern field name
     */
    public const PATTERN = 'pattern';

    /**
     * Status field name
     */
    public const STATUS = 'is_active';

    /**
     * Retrieve profile id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set profile id
     *
     * @param int $profileId
     * @return $this
     */
    public function setId($profileId);

    /**
     * Retrieve entity type
     *
     * @return string
     */
    public function getEntityType();

    /**
     * Set entity type
     *
     * @param string $entityType
     * @return $this
     */
    public function setEntityType($entityType);

    /**
     * Retrieve store id
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Set store id
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId($storeId);

    /**
     * Retrieve prefix
     *
     * @return string
     */
    public function getPrefix();

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix($prefix);

    /**
     * Retrieve suffix
     *
     * @return string
     */
    public function getSuffix();

    /**
     * Set suffix
     *
     * @param string $suffix
     * @return $this
     */
    public function setSuffix($suffix);

    /**
     * Retrieve start value
     *
     * @return string
     */
    public function getStartValue();

    /**
     * Set start value
     *
     * @param string $startValue
     * @return $this
     */
    public function setStartValue($startValue);

    /**
     * Retrieve max value
     *
     * @return string
     */
    public function getMaxValue();

    /**
     * Set max value
     *
     * @param string $maxValue
     * @return $this
     */
    public function setMaxValue($maxValue);

    /**
     * Retrieve warning value
     *
     * @return string
     */
    public function getWarningValue();

    /**
     * Set warning value
     *
     * @param string $warningValue
     * @return $this
     */
    public function setWarningValue($warningValue);

    /**
     * Retrieve step
     *
     * @return string
     */
    public function getStep();

    /**
     * Set step
     *
     * @param string $step
     * @return $this
     */
    public function setStep($step);

    /**
     * Retrieve pattern
     *
     * @return string
     */
    public function getPattern();

    /**
     * Set pattern
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern($pattern);

    /**
     * Whether the profile is active
     *
     * @return string
     */
    public function getIsActive();

    /**
     * Set whether the profile is active
     *
     * @param string $status
     * @return $this
     */
    public function setIsActive($status);
}
