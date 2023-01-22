<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Controller\Adminhtml\Profile;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\GetProfileByIdInterface;
use Faonni\SalesSequence\Api\SaveProfileInterface;

/**
 * Save controller
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Faonni_SalesSequence::profile';

    /**
     * @var GetProfileByIdInterface
     */
    private $getProfileById;

    /**
     * @var SaveProfileInterface
     */
    private $saveProfile;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param GetProfileByIdInterface $getProfileById
     * @param SaveProfileInterface $saveProfile
     */
    public function __construct(
        Context $context,
        GetProfileByIdInterface $getProfileById,
        SaveProfileInterface $saveProfile
    ) {
        $this->getProfileById = $getProfileById;
        $this->saveProfile = $saveProfile;

        parent::__construct(
            $context
        );
    }

    /**
     * Save profile
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $data = $this->getRequest()->getPost('profile');
        $profileId = (int)$this->getRequest()->getParam(ProfileInterface::PROFILE_ID);
        /** @var \Magento\Framework\Controller\Result\Redirect $result */
        $result = $this->resultRedirectFactory->create();
        switch ($this->getRequest()->getParam('back')) {
            case 'edit':
                $result->setPath('*/*/edit', $this->getParams($profileId));
                break;
            default:
                $result->setPath('*/*/index');
        }

        try {
            $profile = $this->getProfileById->execute($profileId);
            $profile->addData($data);
            $this->saveProfile->execute($profile);
            $this->messageManager->addSuccess(
                __('You saved the sequence profile.')
            );
        } catch (\Exception $e) {
            $this->messageManager->addError(
                $e->getMessage()
            );
        }
        return $result;
    }

    /**
     * Retrieve params
     *
     * @param int $profileId
     * @return mixed[]
     */
    private function getParams(int $profileId): array
    {
        return [
            ProfileInterface::PROFILE_ID => $profileId,
            '_current' => true
        ];
    }
}
