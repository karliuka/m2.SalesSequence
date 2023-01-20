<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\ResourceModel;

use Magento\Framework\DB\Select;
use Magento\Framework\Model\AbstractModel;
use Magento\SalesSequence\Model\ResourceModel\Profile as ProfileResource;

/**
 * Profile resource
 */
class Profile extends ProfileResource
{
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
        $select = parent::_getLoadSelect($field, $value, $object);

        $metaField = $this->getConnection()->quoteIdentifier(
            sprintf('%s.%s', $this->getMainTable(), 'meta_id')
        );

        $select->join(
            ['meta' => $this->getTable('sales_sequence_meta')],
            $metaField . ' = meta.meta_id',
            ['meta.entity_type', 'meta.store_id']
        );
        return $select;
    }
}
