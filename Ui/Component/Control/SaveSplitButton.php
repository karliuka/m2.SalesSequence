<?php
/**
 * Copyright © Karliuka Vitalii(karliuka.vitalii@gmail.com)
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Faonni\SalesSequence\Ui\Component\Control;

use Magento\Framework\AuthorizationInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Ui\Component\Control\Container;

/**
 * Represents split-button with pre-configured options
 * Provide an ability to show drop-down list with options clicking on the "Save" button
 */
class SaveSplitButton implements ButtonProviderInterface
{
    /**
     * @var AuthorizationInterface
     */
    private $authorization;

    /**
     * @var string
     */
    private $targetName;

    /**
     * @var string
     */
    private $aclResource;

    /**
     * Initialize button provider
     *
     * @param AuthorizationInterface $authorization
     * @param string $targetName
     * @param string $aclResource
     * @return void
     */
    public function __construct(
        AuthorizationInterface $authorization,
        string $targetName,
        string $aclResource
    ) {
        $this->authorization = $authorization;
        $this->targetName = $targetName;
        $this->aclResource = $aclResource;
    }

    /**
     * Retrieve button-specified settings
     *
     * @return mixed
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save &amp; Continue'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => $this->targetName,
                                'actionName' => 'save',
                                'params' => [
                                    // first param is redirect flag
                                    false,
                                    [
                                        'save_and_continue' => true,
                                    ],
                                ]
                            ]
                        ]
                    ]
                ]
            ],
            'class_name' => Container::SPLIT_BUTTON,
            'options' => $this->getOptions(),
            'sort_order' => 40,
            'disabled' => !$this->isAllowed()
        ];
    }

    /**
     * Retrieve button options
     *
     * @return mixed[]
     */
    private function getOptions(): array
    {
        $options = [
            [
                'label' => __('Save &amp; Close'),
                'data_attribute' => [
                    'mage-init' => [
                        'buttonAdapter' => [
                            'actions' => [
                                [
                                    'targetName' => $this->targetName,
                                    'actionName' => 'save',
                                    'params' => [
                                        // first param is redirect flag
                                        true,
                                        [
                                            'save_and_continue' => false,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'sort_order' => 10,
            ]
        ];
        return $options;
    }

    /**
     * Check current user permission on resource and privilege
     *
     * @return  bool
     */
    private function isAllowed(): bool
    {
        return $this->authorization->isAllowed($this->aclResource);
    }
}
