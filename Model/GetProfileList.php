<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Faonni\SalesSequence\Api\GetProfileListInterface;
use Faonni\SalesSequence\Api\Data\ProfileSearchResultInterface;
use Faonni\SalesSequence\Api\Data\ProfileSearchResultInterfaceFactory;
use Faonni\SalesSequence\Model\ResourceModel\Profile\CollectionFactory;

/**
 * Find profiles by search criteria
 *
 * @api
 */
class GetProfileList implements GetProfileListInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var ProfileSearchResultInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * Initialize provider
     *
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     * @param ProfileSearchResultInterfaceFactory $searchResultsFactory
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor,
        ProfileSearchResultInterfaceFactory $searchResultsFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * Retrieve list of profiles
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return ProfileSearchResultInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): ProfileSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        if (null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        }

        $this->collectionProcessor->process($searchCriteria, $collection);

        $items = [];
        /** @var \Faonni\SalesSequence\Api\Data\ProfileInterface $profile */
        foreach ($collection->getItems() as $profile) {
            $items[$profile->getId()] = $profile;
        }

        /** @var ProfileSearchResultInterface $searchResult */
        $searchResult = $this->searchResultsFactory->create();
        $searchResult->setItems($items);
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}
