<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile as Action;

/**
 * Profile index controller
 */
class Index extends Action
{
    /**
     * Profile grid page
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('Faonni_Sequence::profile');

        $title = $result->getConfig()->getTitle();
        $title->prepend((string)__('Sequence Profiles'));

        return $result;
    }
}
