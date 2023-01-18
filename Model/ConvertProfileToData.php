<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Magento\Framework\Model\AbstractModel;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterfaceFactory;
use Faonni\SalesSequence\Api\Data\ProfileExtensionFactory;
use Faonni\SalesSequence\Api\ConvertProfileToDataInterface;

/**
 * Convert profile model to data
 */
class ConvertProfileToData implements ConvertProfileToDataInterface
{
    /**
     * @var ProfileInterfaceFactory
     */
    private $profileDataFactory;

    /**
     * @var ProfileExtensionFactory
     */
    private $extensionFactory;

    /**
     * Initialize converter
     *
     * @param ProfileInterfaceFactory $profileDataFactory
     * @param ProfileExtensionFactory $extensionFactory
     */
    public function __construct(
        ProfileInterfaceFactory $profileDataFactory,
        ProfileExtensionFactory $extensionFactory
    ) {
        $this->profileDataFactory = $profileDataFactory;
        $this->extensionFactory = $extensionFactory;
    }

    /**
     * Convert profile to data
     *
     * @param AbstractModel $model
     * @return ProfileInterface
     */
    public function execute(AbstractModel $model): ProfileInterface
    {
        $data = $this->convertExtensionAttributesToObject(
            $model->getData()
        );
        return $this->profileDataFactory->create(['data' => $data]);
    }

    /**
     * Convert extension attributes of model to object if it is an array
     *
     * @param mixed[] $data
     * @return mixed[]
     */
    private function convertExtensionAttributesToObject(array $data)
    {
        if (!isset($data['extension_attributes'])) {
            $data['extension_attributes'] = [];
        }

        if (is_array($data['extension_attributes'])) {
            $data['extension_attributes'] = $this->extensionFactory->create(
                ['data' => $data['extension_attributes']]
            );
        }
        return $data;
    }
}
