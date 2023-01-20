<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Magento\Framework\Validation\ValidationException;
use Magento\Framework\Validation\ValidationResult;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\ValidateProfileInterface;
use Faonni\SalesSequence\Model\Profile\ValidatorInterface;

/**
 * Validate profile data
 *
 * @api
 */
class ValidateProfile implements ValidateProfileInterface
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * Initialize provider
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(
        ValidatorInterface $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * Validate profile
     *
     * @param ProfileInterface $profile
     * @return bool
     * @throws ValidationException
     */
    public function execute(ProfileInterface $profile): bool
    {
        /** @var ValidationResult $result */
        $result = $this->validator->validate($profile);
        if (!$result->isValid()) {
            throw new ValidationException(__('Validation Failed'), null, 0, $result);
        }
        return true;
    }
}
