<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Magento\Framework\Exception\NoSuchEntityException;
use Faonni\SalesSequence\Model\ResourceModel\Profile as ProfileResource;
use Faonni\SalesSequence\Api\Data\ProfileInterfaceFactory;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\GetProfileByIdInterface;

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
    private $profileResource;

    /**
     * @var ProfileInterfaceFactory
     */
    private $profileFactory;

    /**
     * Initialize provider
     *
     * @param ProfileResource $profileResource
     * @param ProfileInterfaceFactory $profileFactory
     */
    public function __construct(
        ProfileResource $profileResource,
        ProfileInterfaceFactory $profileFactory
    ) {
        $this->profileResource = $profileResource;
        $this->profileFactory = $profileFactory;
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
        $profile = $this->profileFactory->create();
        /** @var \Magento\Framework\Model\AbstractModel $profile */
        $this->profileResource->load($profile, $profileId, ProfileInterface::PROFILE_ID);
        /** @var ProfileInterface $profile */
        if (!$profile->getId()) {
            throw new NoSuchEntityException(
                __('Profile with id %1 does not exist.', $profileId)
            );
        }
        return $profile;
    }
}
