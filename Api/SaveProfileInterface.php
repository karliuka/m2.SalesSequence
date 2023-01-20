<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api;

use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Validation\ValidationException;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Save profile data
 *
 * @api
 */
interface SaveProfileInterface
{
    /**
     * Save profile
     *
     * @param ProfileInterface $profile
     * @return ProfileInterface
     * @throws CouldNotSaveException
     * @throws ValidationException
     */
    public function execute(ProfileInterface $profile): ProfileInterface;
}
