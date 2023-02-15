<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\ResourceModel;

use Magento\Framework\DB\Select;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Sales sequence profile resource
 */
class Profile extends AbstractDb
{
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'faonni_sales_sequence_profile';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('sales_sequence_profile', ProfileInterface::PROFILE_ID);
    }

    /**
     * Retrieve select object for load object data
     *
     * @param string $field
     * @param mixed $value
     * @param AbstractModel $object
     * @return Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $metaField = sprintf('%s.%s', $this->getMainTable(), 'meta_id');

        $select = parent::_getLoadSelect($field, $value, $object);
        $select->join(
            ['meta' => $this->getTable('sales_sequence_meta')],
            $metaField . ' = meta.meta_id',
            ['meta.entity_type', 'meta.store_id']
        );
        return $select;
    }
}
