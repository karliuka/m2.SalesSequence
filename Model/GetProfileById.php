<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\SalesSequence\Model\ProfileFactory;
use Faonni\SalesSequence\Model\ResourceModel\Profile as ProfileResource;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\GetProfileByIdInterface;
use Faonni\SalesSequence\Api\ConvertProfileToDataInterface;

/**
 * Get profile by profile id
 *
 * @api
 */
class GetProfileById implements GetProfileByIdInterface
{
    /**
     * @var ProfileResource
     */
    private $resource;

    /**
     * @var ProfileFactory
     */
    private $factory;

    /**
     * @var ConvertProfileToDataInterface
     */
    private $convertProfileToData;

    /**
     * Initialize provider
     *
     * @param ProfileResource $resource
     * @param ConvertProfileToDataInterface $convertProfileToData
     * @param ProfileFactory $factory
     */
    public function __construct(
        ProfileResource $resource,
        ConvertProfileToDataInterface $convertProfileToData,
        ProfileFactory $factory
    ) {
        $this->resource = $resource;
        $this->convertProfileToData = $convertProfileToData;
        $this->factory = $factory;
    }

    /**
     * Retrieve profile by id
     *
     * @param int $profileId
     * @return ProfileInterface
     * @throws NoSuchEntityException
     */
    public function execute($profileId): ProfileInterface
    {
        /** @var \Magento\Framework\Model\AbstractModel $profile */
        $profile = $this->factory->create();
        $this->resource->load($profile, $profileId, ProfileInterface::PROFILE_ID);

        if (!$profile->getId()) {
            throw new NoSuchEntityException(
                __('Profile with id "%value" does not exist.', ['value' => $profileId])
            );
        }
        return $this->convertProfileToData->execute($profile);
    }
}
