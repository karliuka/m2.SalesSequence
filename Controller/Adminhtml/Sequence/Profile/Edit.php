<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile;

use Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile as AbstractController;

/**
 * Profile edit controller
 */
class Edit extends AbstractController
{
    /**
     * Editing existing profile form
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $profile = $this->initProfile();
        if ($profile) {
            $this->coreRegistry->register(
                'current_sequence_profile',
                $profile
            );
            /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
            $resultPage = $this->resultPageFactory->create();
            $resultPage->setActiveMenu(
                'Faonni_Sequence::profile'
            );
            $resultPage->getConfig()->getTitle()->prepend(
                __('Sequence Profiles')
            );
            $resultPage->getConfig()->getTitle()->prepend(
                __('Edit Profile')
            );
            return $resultPage;
        } else {
            $this->messageManager->addError(
                __('We can\'t find this sequence profile.')
            );
            /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('sales/');
        }
    }
}
