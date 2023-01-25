<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Profile search results interface
 *
 * @api
 */
interface ProfileSearchResultInterface extends SearchResultsInterface
{
    /**
     * Retrieve profiles
     *
     * @return \Faonni\SalesSequence\Api\Data\ProfileInterface[]
     */
    public function getItems();

    /**
     * Set profiles
     *
     * @param \Faonni\SalesSequence\Api\Data\ProfileInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
