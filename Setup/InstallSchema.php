<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\SalesSequence\Model\Sequence;

/**
 * Install sales sequence
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Installs DB schema
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        $salesSequenceProfileTableName = $installer->getTable('sales_sequence_profile');
        $connection = $installer->getConnection();
        $connection->addColumn(
            $salesSequenceProfileTableName,
            'pattern',
            [
                'type' => Table::TYPE_TEXT,
                'length' => 32,
                'default' => null,
                'comment' => 'Profile Pattern'
            ]
        );
        $installer->endSetup();
    }
}
