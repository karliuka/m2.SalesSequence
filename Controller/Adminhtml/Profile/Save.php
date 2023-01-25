<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Controller\Adminhtml\Profile;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Validation\ValidationException;
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
    const ADMIN_RESOURCE = 'Faonni_SalesSequence::profile_edit';

    /**
     * @var GetProfileByIdInterface
     */
    private $getProfileById;

    /**
     * @var SaveProfileInterface
     */
    private $saveProfile;

    /**
     * @var DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * Initialize controller
     *
     * @param Context $context
     * @param DataObjectHelper $dataObjectHelper
     * @param GetProfileByIdInterface $getProfileById
     * @param SaveProfileInterface $saveProfile
     */
    public function __construct(
        Context $context,
        DataObjectHelper $dataObjectHelper,
        GetProfileByIdInterface $getProfileById,
        SaveProfileInterface $saveProfile
    ) {
        $this->dataObjectHelper = $dataObjectHelper;
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
        $profileId = $this->getProfileId();
        /** @var \Magento\Framework\Controller\Result\Redirect $result */
        $result = $this->resultRedirectFactory->create();
        if (null === $profileId) {
            $this->messageManager->addError(
                (string)__('Please correct the sequence profile you requested.')
            );
            return $result->setPath('*/*/index');
        }

        /** prepare result redirect */
        switch ($this->getRequest()->getParam('back')) {
            case 'edit':
                $result->setPath('*/*/edit', $this->getParams($profileId));
                break;
            default:
                $result->setPath('*/*/index');
        }

        try {
            $data = (array)$this->getRequest()->getParam('profile');
            $profile = $this->getProfileById->execute($profileId);

            $this->dataObjectHelper->populateWithArray($profile, $data, ProfileInterface::class);
            $this->saveProfile->execute($profile);

            $this->messageManager->addSuccess(
                (string)__('You saved the sequence profile.')
            );
        } catch (ValidationException $e) {
            foreach ($e->getErrors() as $error) {
                $this->messageManager->addError(
                    $error->getMessage()
                );
            }
        } catch (LocalizedException $e) {
            $this->messageManager->addError(
                $e->getMessage()
            );
        } catch (\Exception $e) {
            $this->messageManager->addExceptionMessage(
                $e,
                (string)__('Something went wrong while saving the sequence profile.')
            );
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

    /**
     * Retrieve params
     *
     * @param int $profileId
     * @return mixed[]
     */
    private function getParams($profileId): array
    {
        return [
            ProfileInterface::PROFILE_ID => $profileId
        ];
    }
}
