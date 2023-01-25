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
 * Check that value is integer
 */
class RangeValidator implements ValidatorInterface
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
        $values = [
            ProfileInterface::START_VALUE => $profile->getStartValue(),
            ProfileInterface::MAX_VALUE => $profile->getMaxValue(),
            ProfileInterface::WARNING_VALUE => $profile->getWarningValue(),
            ProfileInterface::STEP => $profile->getStep()
        ];

        $errors = [];
        foreach ($values as $field => $value) {
            if (false === filter_var($value, FILTER_VALIDATE_INT)) {
                $errors[] = __('The %1 field must contain only integer value.', $field);
            } elseif ($value <= 0) {
                $errors[] = __('The %1 field must greater than 0.', $field);
            }
        }
        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
