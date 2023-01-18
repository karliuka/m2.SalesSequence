<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Block\Adminhtml\Profile\Edit\Tab;

use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * General tab
 */
class General extends Generic implements TabInterface
{
    /**
     * @var StoreOptionHash
     */
    private $storeOption;

    /**
     * Retrieve Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('General Information');
    }

    /**
     * Retrieve Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('General Information');
    }

    /**
     * Can show tab in tabs
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Tab is hidden
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Prepare properties form
     *
     * @return \Magento\Backend\Block\Widget\Form
     */
    protected function _prepareForm()
    {
        /** @var \Magento\SalesSequence\Model\Profile|null $model */
        $model = $this->_coreRegistry->registry('current_sequence_profile');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'general_fieldset',
            ['legend' => __('General Information')]
        );

        $fieldset->addField(
            'profile_id',
            'hidden',
            [
                'name' => 'profile_id'
            ]
        );

        $fieldset->addField(
            'entity_type',
            'text',
            [
                'name' => 'entity_type',
                'label' => __('Entity Type'),
                'disabled' => true
            ]
        );

        $fieldset->addField(
            'store_id',
            'select',
            [
                'name' => 'store_id',
                'label' => __('Store View'),
                'options' => [],
                'disabled' => true
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'label' => __('Status'),
                'name' => 'is_active',
                'options' => ['1' => __('Active'), '0' => __('Inactive')]
            ]
        );

        if ($model) {
            $form->addValues((array)$model->getData());
        }
        $this->setForm($form);

        $this->_eventManager->dispatch(
            'faonni_sales_sequence_profile_edit_tab_general_prepare_form',
            ['form' => $form]
        );

        return parent::_prepareForm();
    }
}
