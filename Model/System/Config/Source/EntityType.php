<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Model\System\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\SalesSequence\Model\EntityPool;

/**
 * Entity type source
 */
class EntityType implements OptionSourceInterface
{
    /**
     * @var EntityPool
     */
    private $entityPool;

    /**
     * @var mixed[]
     */
    private $options;

    /**
     * Initialize source
     *
     * @param EntityPool $entityPool
     */
    public function __construct(
        EntityPool $entityPool
    ) {
        $this->entityPool = $entityPool;
    }

    /**
     * Retrieve options as array
     *
     * @return mixed[]
     */
    public function toOptionArray()
    {
        if (null === $this->options) {
            foreach ($this->entityPool->getEntities() as $entityType) {
                $this->options[] = ['value' => $entityType, 'label' => $entityType];
            }
        }
        return $this->options;
    }
}
