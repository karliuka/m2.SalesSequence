<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Block\Adminhtml\Profile\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

/**
 * Profile form
 */
class Form extends Generic
{
    /**
     * Intialize form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();

        $this->setData('id', 'faonni_salessequence_profile_form');
        $this->setData('title', __('Edit Profile'));
    }

    /**
     * Prepare form fields and structure
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(['data' => [
            'id' => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post']
        ]);

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
