<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Plugin\SalesSequence\Model;

use Magento\Framework\DB\Sequence\SequenceInterface;
use Magento\SalesSequence\Model\ResourceModel\Meta as ResourceSequenceMeta;
use Magento\SalesSequence\Model\SequenceFactory;
use Magento\SalesSequence\Model\Sequence;
use Magento\SalesSequence\Model\Manager;

/**
 * SalesSequence manager
 */
class ManagerPlugin
{
    /**
     * Sequence meta resource
     *
     * @var ResourceSequenceMeta
     */
    protected $resourceSequenceMeta;

    /**
     * Sequence factory
     *
     * @var SequenceFactory
     */
    protected $sequenceFactory;

    /**
     * Initialize manager
     *
     * @param ResourceSequenceMeta $resourceSequenceMeta
     * @param SequenceFactory $sequenceFactory
     */
    public function __construct(
        ResourceSequenceMeta $resourceSequenceMeta,
        SequenceFactory $sequenceFactory
    ) {
        $this->resourceSequenceMeta = $resourceSequenceMeta;
        $this->sequenceFactory = $sequenceFactory;
    }

    /**
     * Returns sequence for given entityType and store
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
        $meta = $this->resourceSequenceMeta->loadByEntityTypeAndStore($entityType, $storeId);
        $pattern = $meta->getActiveProfile()->getPattern();
        return $this->sequenceFactory->create([
            'meta' => $meta,
            'pattern' => $pattern ?: Sequence::DEFAULT_PATTERN
        ]);
    }
}
