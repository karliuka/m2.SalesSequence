<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
namespace Faonni\SalesSequence\Block\Adminhtml\Profile\Grid\Options;

use Magento\Framework\Option\ArrayInterface as OptionInterface;
use Magento\Store\Model\System\Store;

/**
 * Store option
 */
class StoreOptionHash implements OptionInterface
{
    /**
     * System store
     *
     * @var Store
     */
    protected $systemStore;

    /**
     * Initialize block
     *
     * @param Store $systemStore
     */
    public function __construct(
        Store $systemStore
    ) {
        $this->systemStore = $systemStore;
    }

    /**
     * Return store array
     *
     * @return mixed[]
     */
    public function toOptionArray()
    {
        return $this->systemStore->getStoreOptionHash(true);
    }
}
