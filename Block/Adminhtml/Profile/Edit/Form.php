<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Block\Adminhtml\Profile\Edit;

use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Backend\Block\Widget\Form\Generic as FormGeneric;
use Magento\Backend\Block\Template\Context;
use Faonni\SalesSequence\Block\Adminhtml\Profile\Grid\Options\StoreOptionHash;

/**
 * Profile form
 */
class Form extends FormGeneric
{
    /**
     * Store option
     *
     * @var StoreOptionHash
     */
    protected $storeOption;

    /**
     * Initialize form
     *
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param StoreOptionHash $storeOption
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        StoreOptionHash $storeOption,
        array $data = []
    ) {
        $this->storeOption = $storeOption;

        parent::__construct(
            $context,
            $registry,
            $formFactory,
            $data
        );
    }

    /**
     * Prepare form fields and structure
     *
     * @return $this
     */
    protected function _prepareForm()
    {
        $model = $this->_coreRegistry->registry('current_sequence_profile');
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(['data' => [
            'id' => 'edit_form',
            'action' => $this->getData('action'),
            'method' => 'post']
        ]);

        $fieldset = $form->addFieldset(
            'base_fieldset',
            ['legend' => __('Profile Information')]
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
                'options' => $this->storeOption->toOptionArray(),
                'disabled' => true
            ]
        );

        $fieldset->addField(
            'prefix',
            'text',
            [
                'name' => 'prefix',
                'label' => __('Prefix')
            ]
        );

        $fieldset->addField(
            'suffix',
            'text',
            [
                'name' => 'suffix',
                'label' => __('Suffix')
            ]
        );

        $fieldset->addField(
            'start_value',
            'text',
            [
                'name' => 'start_value',
                'label' => __('Start Value'),
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

        $fieldset->addField(
            'pattern',
            'text',
            [
                'name' => 'pattern',
                'label' => __('Pattern')
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
            $form->addValues($model->getData());
        }

        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}
