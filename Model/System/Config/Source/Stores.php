<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Store\Model\System\Store;

/**
 * Stores source
 */
class Stores implements OptionSourceInterface
{
    /**
     * @var Store
     */
    private $systemStore;

    /**
     * @var mixed[]
     */
    private $options;

    /**
     * Initialize source
     *
     * @param Store $systemStore
     */
    public function __construct(
        Store $systemStore
    ) {
        $this->systemStore = $systemStore;
    }

    /**
     * Retrieve options as array
     *
     * @return mixed[]
     */
    public function toOptionArray()
    {
        if (null === $this->options) {
            foreach ($this->systemStore->getStoreOptionHash(true) as $value => $label) {
                $this->options[] = ['value' => $value, 'label' => $label];
            }
        }
        return $this->options;
    }
}
