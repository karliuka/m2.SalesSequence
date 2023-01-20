<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\Profile;

use Magento\Framework\Validation\ValidationResult;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Extension point for base validation of profile
 *
 * @api
 */
interface ValidatorInterface
{
    /**
     * Validate profile attribute values
     *
     * @param ProfileInterface $profile
     * @return ValidationResult
     */
    public function validate(ProfileInterface $profile): ValidationResult;
}
