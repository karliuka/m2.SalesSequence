<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api;

use Magento\Framework\Exception\NoSuchEntityException;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Get profile by id
 *
 * @api
 */
interface GetProfileByIdInterface
{
    /**
     * Retrieve profile by id
     *
     * @param int $profileId
     * @return ProfileInterface
     * @throws NoSuchEntityException
     */
    public function execute($profileId): ProfileInterface;
}
