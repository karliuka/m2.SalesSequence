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
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterfaceFactory;
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
     * @var SaveProfileInterface
     */
    private $saveProfile;

    /**
     * @var ProfileInterfaceFactory
     */
    private $profileDataFactory;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param ProfileInterfaceFactory $profileDataFactory
     * @param SaveProfileInterface $saveProfile
     */
    public function __construct(
        Context $context,
        ProfileInterfaceFactory $profileDataFactory,
        SaveProfileInterface $saveProfile
    ) {
        $this->saveProfile = $saveProfile;
        $this->profileDataFactory = $profileDataFactory;

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
        $profileId = (int)$this->getRequest()->getPost(ProfileInterface::PROFILE_ID);
        /** @var Redirect $result */
        $result = $this->resultRedirectFactory->create();

        try {
            $profile = $this->profileDataFactory->create(['data' => $data]);
            $this->saveProfile->execute($profile);
            $this->messageManager->addSuccess(
                __('You saved the sequence profile.')
            );
            return $this->resolveResult($result, (int)$profile->getId());
        } catch (\Exception $e) {
            $this->messageManager->addError(
                $e->getMessage()
            );
        }
        return $result->setPath('*/*/edit', $this->getParams($profileId));
    }

    /**
     * Resolve success result
     *
     * @param Redirect $result
     * @param int $profileId
     * @return ResultInterface
     */
    private function resolveResult(Redirect $result, int $profileId): ResultInterface
    {
        return empty($this->getRequest()->getParam('back'))
            ? $result->setPath('*/*/index')
            : $result->setPath('*/*/edit', $this->getParams($profileId));
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
