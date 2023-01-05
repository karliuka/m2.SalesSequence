<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Block\Adminhtml\Profile\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Ranges tab
 */
class Ranges extends Generic implements TabInterface
{
    /**
     * Retrieve Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Range of Identifier Values');
    }

    /**
     * Retrieve Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Range of Identifier Values');
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
            'ranges_fieldset',
            ['legend' => __('Range of Identifier Values')]
        );

        $fieldset->addField(
            'start_value',
            'text',
            [
                'name' => 'start_value',
                'label' => __('Start Value'),
                'note' => __("The minimum identifier value."),
                'class' => 'required-entry validate-number',
                'required' => true
            ]
        );

        $fieldset->addField(
            'max_value',
            'text',
            [
                'name' => 'max_value',
                'label' => __('Max Value'),
                'note' => __("The maximum identifier value."),
                'class' => 'required-entry validate-number',
                'required' => true
            ]
        );

        $fieldset->addField(
            'warning_value',
            'text',
            [
                'name' => 'warning_value',
                'label' => __('Warning Value'),
                'class' => 'required-entry validate-number',
                'required' => true
            ]
        );

        $fieldset->addField(
            'step',
            'text',
            [
                'name' => 'step',
                'label' => __('Step'),
                'class' => 'required-entry validate-number',
                'required' => true
            ]
        );

        if ($model) {
            $form->addValues((array)$model->getData());
        }
        $this->setForm($form);

        $this->_eventManager->dispatch(
            'faonni_sales_sequence_profile_edit_tab_ranges_prepare_form',
            ['form' => $form]
        );

        return parent::_prepareForm();
    }
}
