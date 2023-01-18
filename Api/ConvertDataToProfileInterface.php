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
 * Convert data to profile model
 *
 * @api
 */
interface ConvertDataToProfileInterface
{
    /**
     * Convert to model
     *
     * @param ProfileInterface $profile
     * @return AbstractModel
     */
    public function execute(ProfileInterface $profile): AbstractModel;
}
