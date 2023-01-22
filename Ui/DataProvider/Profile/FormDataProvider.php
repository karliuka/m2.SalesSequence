<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Ui\DataProvider\Profile;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\EntityManager\HydratorInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Faonni\SalesSequence\Api\GetProfileByIdInterface;

/**
 * Data provider for admin export job form
 *
 * @api
 */
class FormDataProvider extends DataProvider
{
    /**
     * @var GetProfileByIdInterface
     */
    private $getProfileById;

    /**
     * @var HydratorInterface
     */
    private $hydrator;

    /**
     * @var PoolInterface
     */
    private $modifierPool;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * Initialize provider
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Context $context
     * @param GetProfileByIdInterface $getProfileById
     * @param HydratorInterface $hydrator
     * @param PoolInterface $modifierPool
     * @param mixed[] $meta
     * @param mixed[] $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Context $context,
        GetProfileByIdInterface $getProfileById,
        HydratorInterface $hydrator,
        PoolInterface $modifierPool,
        array $meta = [],
        array $data = []
    ) {
        $this->dataPersistor = $context->getDataPersistor();
        $this->modifierPool = $modifierPool;
        $this->getProfileById = $getProfileById;
        $this->hydrator = $hydrator;

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $context->getReporting(),
            $context->getSearchCriteriaBuilder(),
            $context->getRequest(),
            $context->getFilterBuilder(),
            $meta,
            $data
        );
    }

    /**
     * Retrieve data
     *
     * @return mixed[]
     */
    public function getData()
    {
        $profileId = $this->getProfileId();
        if (!isset($this->data[$profileId])) {
            $this->data[$profileId]['profile'] = $this->modifyData($this->loadData($profileId));
        }
        return $this->data;
    }

    /**
     * Retrieve meta data
     *
     * @return mixed[]
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        /** @var ModifierInterface $modifier */
        foreach ($this->modifierPool->getModifiersInstances() as $modifier) {
            $meta = $modifier->modifyMeta($meta);
        }
        return $meta;
    }

    /**
     * Retrieve profile id
     *
     * @return int|null
     */
    private function getProfileId(): ?int
    {
        $profileId = $this->request->getParam($this->getRequestFieldName());
        return $profileId ? (int)$profileId : null;
    }

    /**
     * Retrieve profile data
     *
     * @param int|null $profileId
     * @return mixed[]
     */
    private function loadData($profileId): array
    {
        $data = $this->dataPersistor->get('faonni_sales_sequence_profile') ?: [];//?
        if (null !== $profileId) {
            $profile = $this->getProfileById->execute($profileId);
            $data = $this->hydrator->extract($profile);//?
        }
        $this->dataPersistor->clear('faonni_sales_sequence_profile');//?

        return $data;
    }

    /**
     * Retrieve modifier data
     *
     * @param  mixed[] $data
     * @return mixed[]
     */
    private function modifyData(array $data): array
    {
        /** @var ModifierInterface $modifier */
        foreach ($this->modifierPool->getModifiersInstances() as $modifier) {
            $data = $modifier->modifyData($data);
        }
        return $data;
    }
}
