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
 * Sequence Profile Controller
 */
abstract class Profile extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Faonni_Sequence::profile';
	
    /**
     * Active Menu Path
     */
    const ACTIVE_MENU = 'Faonni_Sequence::profile';
	
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
	
    /**
     * Sequence Profile
     *
     * @var \Magento\SalesSequence\Model\Profile
     */
    protected $_profile;
    
    /**
     * Sequence Meta
     *
     * @var \Magento\SalesSequence\Model\Meta
     */
    protected $_meta;
    
    /**
     * Result Page Factory
     *
     * @var PageFactory
     */
    protected $resultPageFactory;
    
    /**
     * Initialize Controller
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
        $this->_coreRegistry = $coreRegistry;
		$this->_profile = $profileFactory->create();
		$this->_meta = $metaFactory->create();
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
    protected function _initProfile()
    {
        $profileId = $this->getRequest()->getParam('profile_id');
        if ($profileId) {
			$profile = $this->_profile->load($profileId);
			if ($profile) {
				$meta = $this->_meta->load($profile->getMetaId());
				$profile->setData('entity_type', $meta->getEntityType());
				$profile->setData('store_id', $meta->getStoreId());
				return $profile;			
			}
        }
        return false;
    }
}
