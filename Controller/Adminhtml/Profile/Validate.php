<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Controller\Adminhtml\Profile;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterfaceFactory;
use Faonni\SalesSequence\Api\ValidateProfileInterface;

/**
 * Validate profile
 */
class Validate extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'Faonni_SalesSequence::profile';

    /**
     * @var ProfileInterfaceFactory
     */
    private $profileDataFactory;

    /**
     * @var ValidateProfileInterface
     */
    private $validateProfile;

    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param ProfileInterfaceFactory $profileDataFactory
     * @param ValidateProfileInterface $validateProfile
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        ProfileInterfaceFactory $profileDataFactory,
        ValidateProfileInterface $validateProfile
    ) {
        $this->profileDataFactory = $profileDataFactory;
        $this->validateProfile = $validateProfile;
        $this->resultJsonFactory = $resultJsonFactory;

        parent::__construct(
            $context
        );
    }

    /**
     * Validate profile
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $response = ['error' => true];
        $data = $this->getRequest()->getPost('profile');
        //$profileId = $data[ProfileInterface::PROFILE_ID] ?? null;

        try {
            $profile = $this->profileDataFactory->create(['data' => $data]);
            $this->validateProfile->execute($profile);
            $response = ['error' => false];
        } catch (\Exception $e) {
            //$this->resolveException->execute($e, self::ACTION_NAME);
            $response['messages'] = [];
            //foreach ($this->messageManager->getMessages(true)->getErrors() as $message) {
                $response['messages'][] = $e->getMessages();
            //}
        }
        return $this->resultJsonFactory->create()->setData($response);
    }
}
