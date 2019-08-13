<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Controller\Adminhtml\Sequence;

use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\SalesSequence\Model\ProfileFactory;
use Magento\SalesSequence\Model\MetaFactory;

/**
 * Sequence profile controller
 */
abstract class Profile extends Action
{
    /**
     * Core registry
     *
     * @var Registry
     */
    protected $coreRegistry;

    /**
     * Sequence profile
     *
     * @var ProfileFactory
     */
    protected $profileFactory;

    /**
     * Sequence meta
     *
     * @var MetaFactory
     */
    protected $metaFactory;

    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param Registry $coreRegistry
     * @param ProfileFactory $profileFactory
     * @param MetaFactory $metaFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        ProfileFactory $profileFactory,
        MetaFactory $metaFactory,
        PageFactory $resultPageFactory
    ) {
        $this->coreRegistry = $coreRegistry;
        $this->profileFactory = $profileFactory;
        $this->metaFactory = $metaFactory;
        $this->resultPageFactory = $resultPageFactory;

        parent::__construct(
            $context
        );
    }

    /**
     * Initialize profile model based on profile id in request
     *
     * @return \Magento\SalesSequence\Model\Profile|false
     */
    protected function initProfile()
    {
        $profileId = $this->getRequest()->getParam('profile_id');
        if ($profileId) {
            $profile = $this->profileFactory->create()->load($profileId);
            if ($profile) {
                $meta = $this->metaFactory->create()->load($profile->getMetaId());
                $profile->setData('entity_type', $meta->getEntityType());
                $profile->setData('store_id', $meta->getStoreId());
                return $profile;
            }
        }
        return false;
    }

    /**
     * Check current user permission on resource and privilege
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed(
            'Faonni_Sequence::profile'
        );
    }
}
