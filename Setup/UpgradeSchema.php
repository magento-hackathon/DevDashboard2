<?php

namespace Firegento\DevDashboard\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
{
    /**
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @throws \Zend_Db_Exception
     */
    public function upgrade(\Magento\Framework\Setup\SchemaSetupInterface $setup, \Magento\Framework\Setup\ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        if (version_compare($context->getVersion(), '1.0.1', '<')) {

            $table = $installer->getConnection()->newTable(
                $installer->getTable('firegento_devdashboard_config')
            )->addColumn(
                'firegento_devdashboard_config_id',
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned' => true,],
                'Entity ID'
            )->addColumn(
                'user_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Admin User Id'
            )->addColumn(
                'creation_time',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT,],
                'Creation Time'
            )->addColumn(
                'update_time',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE,],
                'Modification Time'
            )->addColumn(
                'configuration',
                Table::TYPE_TEXT,
                null,
                [],
                'Configuration'
            )->addColumn(
                'use_devdashboard',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '0',],
                'Use Developer Dashboard'
            )->addColumn(
                'is_active',
                Table::TYPE_SMALLINT,
                null,
                ['nullable' => false, 'default' => '1',],
                'Use Developer Dashboard'
            )->addForeignKey(
                $installer->getFkName(
                    'firegento_devdashboard_config',
                    'user_id',
                    'admin_user',
                    'user_id'
                ),
                'user_id',
                $installer->getTable('admin_user'),
                'user_id',
                Table::ACTION_CASCADE
            )->addIndex(
                $installer->getIdxName(
                    'firegento_devdashboard_config',
                    ['user_id'],
                    AdapterInterface::INDEX_TYPE_INDEX),
                ['user_id']

            );
            $installer->getConnection()->createTable($table);
        }

        $installer->endSetup();
    }
}
