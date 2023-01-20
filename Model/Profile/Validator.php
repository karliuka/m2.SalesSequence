<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\Profile;

use Magento\Framework\Validation\ValidationResult;
use Magento\Framework\Validation\ValidationResultFactory;
use Magento\Framework\Exception\LocalizedException;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Profile composite validator
 */
class Validator implements ValidatorInterface
{
    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @var ValidatorInterface[]
     */
    protected $validators;

    /**
     * Initialize validator
     *
     * @param ValidationResultFactory $validationResultFactory
     * @param ValidatorInterface[] $validators
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
        array $validators = []
    ) {
        foreach ($validators as $validator) {
            if (!$validator instanceof ValidatorInterface) {
                throw new LocalizedException(
                    __('Profile validator must implement %1.', ValidatorInterface::class)
                );
            }
        }

        $this->validationResultFactory = $validationResultFactory;
        $this->validators = $validators;
    }

    /**
     * Validate profile attribute values
     *
     * @param ProfileInterface $profile
     * @return ValidationResult
     */
    public function validate(ProfileInterface $profile): ValidationResult
    {
        $errors = [];
        foreach ($this->validators as $validator) {
            $result = $validator->validate($profile);
            if (!$result->isValid()) {
                array_push($errors, ...$result->getErrors());
            }
        }
        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
