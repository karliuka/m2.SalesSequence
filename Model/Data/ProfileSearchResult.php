<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\Data;

use Magento\Framework\Api\SearchResults;
use Faonni\SalesSequence\Api\Data\ProfileSearchResultInterface;

/**
 * Search result
 *
 * @api
 */
class ProfileSearchResult extends SearchResults implements ProfileSearchResultInterface
{
}
