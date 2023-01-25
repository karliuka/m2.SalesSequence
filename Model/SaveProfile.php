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
    private $profileResource;

    /**
     * @var ValidateProfileInterface
     */
    private $validateProfile;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize provider
     *
     * @param ProfileResource $profileResource
     * @param ValidateProfileInterface $validateProfile
     * @param LoggerInterface $logger
     */
    public function __construct(
        ProfileResource $profileResource,
        ValidateProfileInterface $validateProfile,
        LoggerInterface $logger
    ) {
        $this->profileResource = $profileResource;
        $this->validateProfile = $validateProfile;
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
        try {
            /** @var \Magento\Framework\Model\AbstractModel $profile */
            $this->profileResource->save($profile);
            /** @var ProfileInterface $profile */
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CouldNotSaveException(
                __('Could not save the profile with id: %1', $profile->getId())
            );
        }
        return $profile;
    }
}
