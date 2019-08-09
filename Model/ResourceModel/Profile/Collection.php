<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * 
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Model\ResourceModel\Profile;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\SalesSequence\Model\ResourceModel\Profile as ProfileResource;
use Magento\SalesSequence\Model\Profile;


/**
 * Profile ResourceModel Collection
 */
class Collection extends AbstractCollection
{
    /**
     * Name Prefix Of Events That Are Dispatched By Model
     *
     * @var string
     */
    protected $_eventPrefix = 'sales_sequence_profile_collection';

    /**
     * Name Of Event Parameter
     *
     * @var string
     */
    protected $_eventObject = 'collection';
	
    /**
     * Id Field Name
     *
     * @var string
     */
    protected $_idFieldName = 'profile_id';
    
    

    /**
     * Initialize Entity Model And ResourceModel
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Profile::class, ProfileResource::class);      
    }
    
    /**
     * Init Select
     *
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->join(
            ['meta' => $this->getResource()->getTable('sales_sequence_meta')],
            'main_table.meta_id = meta.meta_id',
            ['meta.entity_type', 'meta.store_id']
        );          
        return $this;
    }    
}
