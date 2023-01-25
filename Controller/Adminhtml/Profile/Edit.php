<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Controller\Adminhtml\Profile;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\GetProfileByIdInterface;

/**
 * Edit controller
 */
class Edit extends Action implements HttpGetActionInterface
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
     * Initialize controller
     *
     * @param Context $context
     * @param GetProfileByIdInterface $getProfileById
     */
    public function __construct(
        Context $context,
        GetProfileByIdInterface $getProfileById
    ) {
        $this->getProfileById = $getProfileById;

        parent::__construct(
            $context
        );
    }

    /**
     * Edit model
     *
     * @return ResultInterface
     */
    public function execute(): ResultInterface
    {
        $profileId = $this->getProfileId();
        if (null === $profileId) {
            /** @var \Magento\Framework\Controller\Result\Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addError(
                (string)__('Please correct the sequence profile you requested.')
            );
            return $result->setPath('*/*');
        }

        try {
            /** @var \Magento\Backend\Model\View\Result\Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result->setActiveMenu('Faonni_SalesSequence::profile');
            $profile = $this->getProfileById->execute($profileId);

            $title = $result->getConfig()->getTitle();

            $title->prepend((string)__('Stores'));
            $title->prepend((string)__('Sequence Profiles'));

            $title->prepend(
                $profile->getEntityType()
            );
        } catch (NoSuchEntityException $e) {
            /** @var \Magento\Framework\Controller\Result\Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                (string)__('The profile with id "%1" does not exist.', $profileId)
            );
            $result->setPath('*/*');
        }

        return $result;
    }

    /**
     * Retrieve profile id
     *
     * @return int|null
     */
    private function getProfileId(): ?int
    {
        $profileId = $this->getRequest()->getParam(ProfileInterface::PROFILE_ID);
        if (is_string($profileId) || is_int($profileId)) {
            return (int)$profileId;
        }
        return null;
    }
}
