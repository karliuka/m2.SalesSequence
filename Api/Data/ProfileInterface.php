<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Profile data interface
 *
 * @api
 */
interface ProfileInterface extends ExtensibleDataInterface
{
    /**
     * Profile id field name
     */
    const PROFILE_ID = 'profile_id';

    /**
     * Entity type field name
     */
    const ENTITY_TYPE = 'entity_type';

    /**
     * Store id field name
     */
    const STORE_ID = 'store_id';

    /**
     * Prefix field name
     */
    const PREFIX = 'prefix';

    /**
     * Suffix field name
     */
    const SUFFIX = 'suffix';

    /**
     * Start value field name
     */
    const START_VALUE = 'start_value';

    /**
     * Max value field name
     */
    const MAX_VALUE = 'max_value';

    /**
     * Warning value field name
     */
    const WARNING_VALUE = 'warning_value';

    /**
     * Step field name
     */
    const STEP = 'step';

    /**
     * Pattern field name
     */
    const PATTERN = 'pattern';

    /**
     * Status field name
     */
    const STATUS = 'status';

    /**
     * Retrieve profile id
     *
     * @return int|null
     */
    public function getId(): ?int;

    /**
     * Set profile id
     *
     * @param int $profileId
     * @return $this
     */
    public function setId(int $profileId): ProfileInterface;

    /**
     * Retrieve entity type
     *
     * @return string
     */
    public function getEntityType(): string;

    /**
     * Set entity type
     *
     * @param string $entityType
     * @return $this
     */
    public function setEntityType(string $entityType): ProfileInterface;

    /**
     * Retrieve store id
     *
     * @return int
     */
    public function getStoreId(): int;

    /**
     * Set store id
     *
     * @param int $storeId
     * @return $this
     */
    public function setStoreId(int $storeId): ProfileInterface;

    /**
     * Retrieve prefix
     *
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Set prefix
     *
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(string $prefix): ProfileInterface;

    /**
     * Retrieve suffix
     *
     * @return string
     */
    public function getSuffix(): string;

    /**
     * Set suffix
     *
     * @param string $suffix
     * @return $this
     */
    public function setSuffix(string $suffix): ProfileInterface;

    /**
     * Retrieve start value
     *
     * @return string
     */
    public function getStartValue(): string;

    /**
     * Set start value
     *
     * @param string $startValue
     * @return $this
     */
    public function setStartValue(string $startValue): ProfileInterface;

    /**
     * Retrieve max value
     *
     * @return string
     */
    public function getMaxValue(): string;

    /**
     * Set max value
     *
     * @param string $maxValue
     * @return $this
     */
    public function setMaxValue(string $maxValue): ProfileInterface;

    /**
     * Retrieve warning value
     *
     * @return string
     */
    public function getWarningValue(): string;

    /**
     * Set warning value
     *
     * @param string $warningValue
     * @return $this
     */
    public function setWarningValue(string $warningValue): ProfileInterface;

    /**
     * Retrieve step
     *
     * @return string
     */
    public function getStep(): string;

    /**
     * Set step
     *
     * @param string $step
     * @return $this
     */
    public function setStep(string $step): ProfileInterface;

    /**
     * Retrieve pattern
     *
     * @return string
     */
    public function getPattern(): string;

    /**
     * Set pattern
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern(string $pattern): ProfileInterface;

    /**
     * Whether the profile is active
     *
     * @return int
     */
    public function getStatus(): int;

    /**
     * Set whether the profile is active
     *
     * @param int $status
     * @return $this
     */
    public function setStatus(int $status): ProfileInterface;

    /**
     * Retrieve existing extension attributes object or create a new one
     *
     * @return \Faonni\SalesSequence\Api\Data\ProfileExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object
     *
     * @param \Faonni\SalesSequence\Api\Data\ProfileExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(ProfileExtensionInterface $extensionAttributes);
}
