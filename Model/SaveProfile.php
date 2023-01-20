<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Psr\Log\LoggerInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Validation\ValidationException;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\SaveProfileInterface;
use Faonni\SalesSequence\Api\ValidateProfileInterface;
use Faonni\SalesSequence\Api\ConvertProfileToDataInterface;
use Faonni\SalesSequence\Api\ConvertDataToProfileInterface;
use Faonni\SalesSequence\Model\ResourceModel\Profile as ProfileResource;

/**
 * Save profile data
 *
 * @api
 */
class SaveProfile implements SaveProfileInterface
{
    /**
     * @var ProfileResource
     */
    private $resource;

    /**
     * @var ValidateProfileInterface
     */
    private $validateProfile;

    /**
     * @var ConvertDataToProfileInterface
     */
    private $convertDataToProfile;

    /**
     * @var ConvertProfileToDataInterface
     */
    private $convertProfileToData;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize provider
     *
     * @param ProfileResource $resource
     * @param ValidateProfileInterface $validateProfile
     * @param ConvertDataToProfileInterface $convertDataToProfile
     * @param ConvertProfileToDataInterface $convertProfileToData
     * @param LoggerInterface $logger
     */
    public function __construct(
        ProfileResource $resource,
        ValidateProfileInterface $validateProfile,
        ConvertDataToProfileInterface $convertDataToProfile,
        ConvertProfileToDataInterface $convertProfileToData,
        LoggerInterface $logger
    ) {
        $this->resource = $resource;
        $this->validateProfile = $validateProfile;
        $this->convertDataToProfile = $convertDataToProfile;
        $this->convertProfileToData = $convertProfileToData;
        $this->logger = $logger;
    }

    /**
     * Save profile
     *
     * @param ProfileInterface $profile
     * @return ProfileInterface
     * @throws CouldNotSaveException
     * @throws ValidationException
     */
    public function execute(ProfileInterface $profile): ProfileInterface
    {
        $this->validateProfile->execute($profile);
        /** @var \Eriocnemis\SalesAutoCancelProfile\Model\Profile $model */
        $model = $this->convertDataToProfile->execute($profile);
        try {
            $this->resource->save($model);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CouldNotSaveException(
                __('Could not save the profile with id: %1', $profile->getId())
            );
        }
        return $this->convertProfileToData->execute($model);
    }
}
