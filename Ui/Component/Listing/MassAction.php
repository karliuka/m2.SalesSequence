<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Ui\Component\Listing;

use Magento\Framework\AuthorizationInterface;
use Magento\Framework\View\Element\UiComponentInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Ui\Component\MassAction as AbstractComponent;

/**
 * Mass action UI component
 */
class MassAction extends AbstractComponent
{
    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    /**
     * Initialize component
     *
     * @param AuthorizationInterface $authorization
     * @param ContextInterface $context
     * @param UiComponentInterface[] $components
     * @param mixed[] $data
     */
    public function __construct(
        AuthorizationInterface $authorization,
        ContextInterface $context,
        array $components = [],
        array $data = []
    ) {
        $this->authorization = $authorization;

        parent::__construct(
            $context,
            $components,
            $data
        );
    }

    /**
     * Prepare component configuration
     *
     * @return void
     */
    public function prepare()
    {
        foreach ($this->getChildComponents() as $actionComponent) {
            $config = $actionComponent->getConfiguration();
            $config['actionDisable'] = !$this->isAllowed($config['type']);
            $actionComponent->setData('config', $config);
        }
        parent::prepare();
    }

    /**
     * Check if the given type of action is allowed
     *
     * @param string $actionType
     * @return bool
     */
    public function isAllowed($actionType): bool
    {
        $isAllowed = true;
        switch ($actionType) {
            case 'status':
                $isAllowed = $this->authorization->isAllowed('Faonni_SalesSequence::profile_edit');
                break;
        }
        return $isAllowed;
    }
}
