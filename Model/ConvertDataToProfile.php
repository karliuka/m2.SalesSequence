<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\SalesSequence\Model\ResourceModel\Profile as ProfileResource;
use Magento\SalesSequence\Model\ProfileFactory;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\ConvertDataToProfileInterface;

/**
 * Convert data to profile model
 */
class ConvertDataToProfile implements ConvertDataToProfileInterface
{
    /**
     * @var ProfileResource
     */
    private $resource;

    /**
     * @var ProfileFactory
     */
    private $factory;

    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * Initialize converter
     *
     * @param ProfileResource $resource
     * @param DataObjectProcessor $dataObjectProcessor
     * @param ProfileFactory $factory
     */
    public function __construct(
        ProfileResource $resource,
        DataObjectProcessor $dataObjectProcessor,
        ProfileFactory $factory
    ) {
        $this->resource = $resource;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->factory = $factory;
    }

    /**
     * Convert to model
     *
     * @param ProfileInterface $profile
     * @return AbstractModel
     */
    public function execute(ProfileInterface $profile): AbstractModel
    {
        /** @var \Magento\SalesSequence\Model\Profile $model */
        $model = $this->factory->create();
        if ($profile->getId()) {
            $this->resource->load($model, $profile->getId(), ProfileInterface::PROFILE_ID);
        }

        $data = $this->dataObjectProcessor->buildOutputDataArray($profile, ProfileInterface::class);
        $model->addData($data);

        return $model;
    }
}
