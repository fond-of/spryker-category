<?php

namespace FondOfSpryker\Zed\Category\Communication\Plugin\CategoryNode\Listener;

use Generated\Shared\Transfer\NodeTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @package FondOfSpryker\Zed\Category\Communication\Plugin\Category\Listener
 * @method \FondOfSpryker\Zed\Category\Business\CategoryFacade getFacade()
 */
class CategoryNodeEventListener extends AbstractPlugin implements EventHandlerInterface
{
    /**
     * Specification
     *  - Listeners needs to implement this interface to execute the codes for each
     *  event.CategoryNodeEventListener
     *
     * @api
     *
     * @param \Spryker\Shared\Kernel\Transfer\TransferInterface $transfer
     * @param string $eventName
     *
     * @return void
     */
    public function handle(TransferInterface $transfer, $eventName): void
    {
        $this->handleCreateCategoryNodeEvent($transfer->getCategoryNode());
    }

    /**
     * @param \Generated\Shared\Transfer\NodeTransfer $nodeTransfer
     *
     * @return void
     */
    protected function handleCreateCategoryNodeEvent(NodeTransfer $nodeTransfer): void
    {
        $this->getFacade()->updateCategoryNodeStore($nodeTransfer);
    }
}
