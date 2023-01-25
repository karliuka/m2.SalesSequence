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
use Faonni\SalesSequence\Model\System\Config\Source\Status as StatusSource;

/**
 * Check that status is valid
 */
class StatusValidator implements ValidatorInterface
{
    /**
     * @var ValidationResultFactory
     */
    private $validationResultFactory;

    /**
     * @var StatusSource
     */
    private $statusSource;

    /**
     * Initialize validator
     *
     * @param ValidationResultFactory $validationResultFactory
     * @param StatusSource $statusSource
     */
    public function __construct(
        ValidationResultFactory $validationResultFactory,
        StatusSource $statusSource
    ) {
        $this->validationResultFactory = $validationResultFactory;
        $this->statusSource = $statusSource;
    }

    /**
     * Validate status
     *
     * @param ProfileInterface $profile
     * @return ValidationResult
     */
    public function validate(ProfileInterface $profile): ValidationResult
    {
        $errors = [];
        $statuses = array_column($this->statusSource->toOptionArray(), 'value');
        $status = $profile->getIsActive();

        if (!in_array($status, $statuses)) {
            $errors[] = __('Value for status contains incorrect value.');
        }
        return $this->validationResultFactory->create(['errors' => $errors]);
    }
}
