<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Block\Adminhtml\Profile\Edit;

use Magento\Backend\Block\Widget\Tabs as AbstractTabs;

/**
 * Profile edit tabs
 *
 * @method Tabs setId(string $id)
 */
class Tabs extends AbstractTabs
{
    /**
     * Internal constructor
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setId('profile_tabs');
        $this->setDestElementId('edit_form');
    }
}
