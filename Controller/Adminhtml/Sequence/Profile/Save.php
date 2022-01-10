<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile;

use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Faonni\SalesSequence\Controller\Adminhtml\Sequence\Profile as Action;

/**
 * Profile save controller
 */
class Save extends Action
{
    /**
     * Save profile form processing
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('profile_id');
        $back = $this->getRequest()->getParam('back', false);
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            try {
                $profile = $this->initProfile();

                unset($data['meta_id']);
                $profile->addData($data);

                $this->_session->setProfileData($data);
                $profile->save();

                $this->_session->setProfileData(false);
                $this->messageManager->addSuccess(
                    __('You saved the sequence profile.')
                );
            } catch (LocalizedException $e) {
                $this->_session->setProfileData($data);
                $this->messageManager->addError(
                    $e->getMessage()
                );
                $back = true;
            } catch (\Exception $e) {
                $this->logger->critical($e);
                $this->messageManager->addError(
                    __('We can\'t save the sequence profile right now.')
                );
                $back = true;
            }
        }
        if ($back) {
            return $this->_redirect('*/*/edit', ['profile_id' => $id, '_current' => true]);
        }
        return $this->_redirect('*/*/');
    }
}
