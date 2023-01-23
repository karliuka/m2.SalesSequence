<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Controller\Adminhtml\Profile;

use Psr\Log\LoggerInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Validation\ValidationException;
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
    private $profileFactory;

    /**
     * @var ValidateProfileInterface
     */
    private $validateProfile;

    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param ProfileInterfaceFactory $profileFactory
     * @param ValidateProfileInterface $validateProfile
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        ProfileInterfaceFactory $profileFactory,
        ValidateProfileInterface $validateProfile,
        LoggerInterface $logger
    ) {
        $this->profileFactory = $profileFactory;
        $this->validateProfile = $validateProfile;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->logger = $logger;

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
        $response = ['error' => true, 'messages' => []];
        $data = $this->getRequest()->getParam('profile');

        try {
            $profile = $this->profileFactory->create(['data' => $data]);
            $this->validateProfile->execute($profile);
            $response = ['error' => false];
        } catch (ValidationException $e) {
            foreach ($e->getErrors() as $error) {
                $response['messages'][] = $error->getMessage();
            }
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            $response['messages'][] = __('Something went wrong while validating the sequence profile.');
        }

        return $this->resultJsonFactory->create()->setData($response);
    }
}
