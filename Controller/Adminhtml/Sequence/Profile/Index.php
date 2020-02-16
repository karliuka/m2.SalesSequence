<?php
/**
 * Copyright © 2011-2018 Karliuka Vitalii(karliuka.vitalii@gmail.com)
 *
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile;

use Magento\Framework\App\ResponseInterface;
use Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile as Action;

/**
 * Profile index controller
 */
class Index extends Action
{
    /**
     * Profile grid page
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_setActiveMenu(
            'Faonni_Sequence::profile'
        );
        $this->_view->getPage()->getConfig()->getTitle()->prepend(
            __('Sequence Profiles')
        );
        $this->_view->renderLayout();
    }
}
