<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Status source
 */
class Status implements OptionSourceInterface
{
    /**
     * Value which equal enable for status dropdown
     */
    const ENABLE_VALUE = 1;

    /**
     * Value which equal disable for status dropdown
     */
    const DISABLE_VALUE = 0;

    /**
     * Retrieve options as array
     *
     * @return mixed[]
     */
    public function toOptionArray()
    {
        return [
            ['value' => self::ENABLE_VALUE, 'label' => __('Enable')],
            ['value' => self::DISABLE_VALUE, 'label' => __('Disable')]
        ];
    }
}
