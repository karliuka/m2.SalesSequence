<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Api;

use Magento\Framework\Model\AbstractModel;
use Faonni\SalesSequence\Api\Data\ProfileInterface;

/**
 * Convert profile model to data
 *
 * @api
 */
interface ConvertProfileToDataInterface
{
    /**
     * Convert profile to data
     *
     * @param AbstractModel $model
     * @return ProfileInterface
     */
    public function execute(AbstractModel $model): ProfileInterface;
}
