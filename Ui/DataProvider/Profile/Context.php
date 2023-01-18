<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Ui\DataProvider\Profile;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\RequestInterface;

/**
 * Context of data provider
 */
class Context
{
    /**
     * @var ReportingInterface
     */
    private $reporting;

    /**
     * @var FilterBuilder
     */
    private $filterBuilder;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * Initialize context
     *
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param DataPersistorInterface $dataPersistor
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     */
    public function __construct(
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        DataPersistorInterface $dataPersistor,
        RequestInterface $request,
        FilterBuilder $filterBuilder
    ) {
        $this->request = $request;
        $this->reporting = $reporting;
        $this->dataPersistor = $dataPersistor;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder = $filterBuilder;
    }

    /**
     * Retrieve reporting
     *
     * @return ReportingInterface
     */
    public function getReporting()
    {
        return $this->reporting;
    }

    /**
     * Retrieve filter builder
     *
     * @return FilterBuilder
     */
    public function getFilterBuilder()
    {
        return $this->filterBuilder;
    }

    /**
     * Retrieve data persistor
     *
     * @return DataPersistorInterface
     */
    public function getDataPersistor()
    {
        return $this->dataPersistor;
    }

    /**
     * Retrieve search criteria builder
     *
     * @return SearchCriteriaBuilder
     */
    public function getSearchCriteriaBuilder()
    {
        return $this->searchCriteriaBuilder;
    }

    /**
     * Retrieve request
     *
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }
}
