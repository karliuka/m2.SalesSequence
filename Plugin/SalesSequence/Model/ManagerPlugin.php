<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Plugin\SalesSequence\Model;

use Magento\Framework\DB\Sequence\SequenceInterface;
use Magento\SalesSequence\Model\ResourceModel\Meta as MetaResource;
use Magento\SalesSequence\Model\SequenceFactory;
use Magento\SalesSequence\Model\Sequence;
use Magento\SalesSequence\Model\Manager;

/**
 * Sales sequence manager
 */
class ManagerPlugin
{
    /**
     * @var MetaResource
     */
    private $metaResource;

    /**
     * @var SequenceFactory
     */
    private $sequenceFactory;

    /**
     * Initialize manager
     *
     * @param MetaResource $metaResource
     * @param SequenceFactory $sequenceFactory
     */
    public function __construct(
        MetaResource $metaResource,
        SequenceFactory $sequenceFactory
    ) {
        $this->metaResource = $metaResource;
        $this->sequenceFactory = $sequenceFactory;
    }

    /**
     * Retrieve sequence for given entityType and store
     *
     * @param Manager $subject
     * @param callable $proceed
     * @param string $entityType
     * @param int $storeId
     * @return SequenceInterface
     */
    public function aroundGetSequence(
        Manager $subject,
        callable $proceed,
        $entityType,
        $storeId
    ) {
        /** @var \Magento\SalesSequence\Model\Meta $meta */
        $meta = $this->metaResource->loadByEntityTypeAndStore($entityType, $storeId);
        /** @var \Magento\SalesSequence\Model\Profile $profile */
        $profile = $meta->getData('active_profile');
        return $this->sequenceFactory->create([
            'meta' => $meta,
            'pattern' => $profile->getData('pattern') ?: Sequence::DEFAULT_PATTERN
        ]);
    }
}
