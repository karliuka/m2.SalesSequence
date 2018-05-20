<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile;

use Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile as AbstractController;

/**
 * Profile Index Controller
 */
class Index extends AbstractController
{
    /**
     * Profile grid page
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::ACTIVE_MENU);
        $resultPage->getConfig()->getTitle()->prepend(__('Sequence Profiles'));

        return $resultPage;
    }
}
