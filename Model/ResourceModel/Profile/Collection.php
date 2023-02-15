<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\ResourceModel\Profile;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Faonni\SalesSequence\Model\ResourceModel\Profile as ProfileResource;
use Faonni\SalesSequence\Model\Profile;

/**
 * Sales sequence profile collection
 */
class Collection extends AbstractCollection
{
    /**
     * Name prefix of events that are dispatched by model
     *
     * @var string
     */
    protected $_eventPrefix = 'faonni_sales_sequence_profile_collection';

    /**
     * Name of event parameter
     *
     * @var string
     */
    protected $_eventObject = 'collection';

    /**
     * Primary id field name
     *
     * @var string
     */
    protected $_idFieldName = 'profile_id';

    /**
     * Initialize entity model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Profile::class, ProfileResource::class);
    }

    /**
     * Init select
     *
     * @return $this
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
