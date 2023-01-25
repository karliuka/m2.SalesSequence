<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Faonni\SalesSequence\Api\Data\ProfileSearchResultInterface;

/**
 * Find profiles by search criteria
 *
 * @api
 */
interface GetProfileListInterface
{
    /**
     * Retrieve list of profiles
     *
     * @param SearchCriteriaInterface|null $searchCriteria
     * @return ProfileSearchResultInterface
     */
    public function execute(SearchCriteriaInterface $searchCriteria = null): ProfileSearchResultInterface;
}
