<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Block\Adminhtml\Profile;

use Magento\Backend\Block\Widget\Form\Container;

/**
 * Sequence profile edit
 *
 * @api
 */
class Edit extends Container
{
    /**
     * Initialize container
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'profile';
        $this->_controller = 'adminhtml_profile';
        $this->_blockGroup = 'Faonni_SalesSequence';
        $this->_mode = 'edit';

        parent::_construct();
        $this->removeButton('back');
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return string
     */
    public function getHeaderText()
    {
        return __('Edit Profile');
    }
}
