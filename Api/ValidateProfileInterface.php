<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api;

use Magento\Framework\Validation\ValidationException;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Validate profile data
 *
 * @api
 */
interface ValidateProfileInterface
{
    /**
     * Validate profile
     *
     * @param ProfileInterface $profile
     * @return bool
     * @throws ValidationException
     */
    public function execute(ProfileInterface $profile): bool;
}
