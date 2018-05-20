<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Plugin\SalesSequence\Model;

use Magento\SalesSequence\Model\ResourceModel\Meta as ResourceSequenceMeta;
use Magento\SalesSequence\Model\SequenceFactory;
use Magento\SalesSequence\Model\Sequence;

/**
 * SalesSequence Manager
 */
class Manager
{
    /**
     * Sequence Meta Resource
     *
     * @var \Magento\SalesSequence\Model\ResourceModel\Meta
     */
    protected $resourceSequenceMeta;

    /**
     * Sequence Meta Resource
     *
     * @var \Magento\SalesSequence\Model\SequenceFactory
     */
    protected $sequenceFactory;

    /**
     * Initialize Manager
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
     * @param $subject Manager
     * @param $proceed \Callable	
     * @param string $entityType
     * @param int $storeId   
     * @return \Magento\Framework\DB\Sequence\SequenceInterface
     */	
    public function aroundGetSequence($subject, $proceed, $entityType, $storeId) 
    {
		$meta = $this->resourceSequenceMeta->loadByEntityTypeAndStore($entityType, $storeId);
		$pattern = $meta->getActiveProfile()->getPattern();
        return $this->sequenceFactory->create([
			'meta' => $meta,
			'pattern' => $pattern ?: Sequence::DEFAULT_PATTERN
		]);		
    }	
}
