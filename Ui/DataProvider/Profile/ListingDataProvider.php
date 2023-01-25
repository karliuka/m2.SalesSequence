<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Ui\DataProvider\Profile;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;
use Magento\Ui\DataProvider\SearchResultFactory;
use Magento\Ui\DataProvider\Modifier\PoolInterface;
use Magento\Ui\DataProvider\Modifier\ModifierInterface;
use Faonni\SalesSequence\Api\Data\ProfileInterface;
use Faonni\SalesSequence\Api\GetProfileListInterface;

/**
 * Data provider for admin grid
 *
 * @api
 */
class ListingDataProvider extends DataProvider
{
    /**
     * @var GetProfileListInterface
     */
    private $getProfileList;

    /**
     * @var SearchResultFactory
     */
    private $searchResultFactory;

    /**
     * @var PoolInterface
     */
    private $modifierPool;

    /**
     * Initialize provider
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Context $context
     * @param GetProfileListInterface $getProfileList
     * @param SearchResultFactory $searchResultFactory
     * @param PoolInterface $modifierPool
     * @param mixed[] $meta
     * @param mixed[] $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Context $context,
        GetProfileListInterface $getProfileList,
        SearchResultFactory $searchResultFactory,
        PoolInterface $modifierPool,
        array $meta = [],
        array $data = []
    ) {
        $this->getProfileList = $getProfileList;
        $this->searchResultFactory = $searchResultFactory;
        $this->modifierPool = $modifierPool;

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
        $data = parent::getData();
        /** @var ModifierInterface $modifier */
        foreach ($this->modifierPool->getModifiersInstances() as $modifier) {
            $data = $modifier->modifyData($data);
        }
        return $data;
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
     * Retrieve search result
     *
     * @return SearchResultInterface
     */
    public function getSearchResult()
    {
        $searchCriteria = $this->getSearchCriteria();
        $result = $this->getProfileList->execute($searchCriteria);

        return $this->searchResultFactory->create(
            $result->getItems(),
            $result->getTotalCount(),
            $searchCriteria,
            ProfileInterface::PROFILE_ID
        );
    }
}
