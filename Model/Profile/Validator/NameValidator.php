<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\Profile\Validator;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Model\Profile\ValidatorInterface;

/**
 * Check that name is valid
 */
class NameValidator implements ValidatorInterface
{
    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * Initialize validator
     *
     * @param ValidationResultFactory $validationResultFactory
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory
    ) {
        $this->validationResultFactory = $validationResultFactory;
    }

    /**
     * Validate code
     *
     * @param ProfileInterface $profile
     * @return ValidationResult
     */
    public function validate(ProfileInterface $profile): ValidationResult
    {
        $errors = [];
        $code = trim((string)$profile->getEntityType());
        if ('' === $code) {
            $errors[] = __('Profile name field is required. Enter and try again.');
        }
        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
