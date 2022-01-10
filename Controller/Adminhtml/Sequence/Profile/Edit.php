<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile as Action;

/**
 * Profile edit controller
 */
class Edit extends Action
{
    /**
     * Editing existing profile form
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('Faonni_Sequence::profile');
        try {
            $profile = $this->initProfile();
            $data = $this->_session->getProfileData(true);
            if (!empty($data)) {
                $profile->addData($data);
            }
            $title = $result->getConfig()->getTitle();
            $title->prepend((string)__('Sequence Profiles'));
            $title->prepend((string)__('Edit Profiles'));
        } catch (LocalizedException $e) {
            $this->messageManager->addError($e->getMessage());
            /** @var \Magento\Framework\Controller\Result\Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $result->setPath('*/*/index');
        }
        return $result;
    }
}
