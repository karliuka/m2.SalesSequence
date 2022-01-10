<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Block\Adminhtml\Profile\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;

/**
 * Format tab
 */
class Format extends Generic implements TabInterface
{
    /**
     * Retrieve Tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Formatting Identifier');
    }

    /**
     * Retrieve Tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Formatting Identifier');
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
        $model = $this->_coreRegistry->registry('current_sequence_profile');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $fieldset = $form->addFieldset(
            'format_fieldset',
            ['legend' => __('Formatting Identifier')]
        );

        $fieldset->addField(
            'prefix',
            'text',
            [
                'name' => 'prefix',
                'label' => __('Prefix'),
                'note' => __("The prefix will be added before the identifier number e.g. DE000001. Leave blank if you don't want to use.")
            ]
        );

        $fieldset->addField(
            'suffix',
            'text',
            [
                'name' => 'suffix',
                'label' => __('Suffix'),
                'note' => __("The suffix will be added before the identifier number e.g. 000001ORD. Leave blank if you don't want to use.")
            ]
        );

        $fieldset->addField(
            'pattern',
            'text',
            [
                'name' => 'pattern',
                'label' => __('Pattern'),
                'note' => __("The basic identifier pattern. If empty, the default(%s%'.09d%s) template will be used.")
            ]
        );

        if ($model) {
            $form->addValues($model->getData());
        }
        $this->setForm($form);

        $this->_eventManager->dispatch(
            'faonni_sales_sequence_profile_edit_tab_format_prepare_form',
            ['form' => $form]
        );

        return parent::_prepareForm();
    }
}
