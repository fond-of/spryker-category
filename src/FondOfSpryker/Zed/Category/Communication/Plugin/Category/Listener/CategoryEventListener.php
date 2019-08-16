<?php

namespace FondOfSpryker\Zed\Category\Communication\Plugin\Category\Listener;

use Generated\Shared\Transfer\CategoryTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use Spryker\Zed\Event\Dependency\Plugin\EventHandlerInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @package FondOfSpryker\Zed\Category\Communication\Plugin\Category\Listener
 * @method \FondOfSpryker\Zed\Category\Business\CategoryFacade getFacade()
 */
class CategoryEventListener extends AbstractPlugin implements EventHandlerInterface
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
        $this->handleCreateCategoryEvent($transfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    protected function handleCreateCategoryEvent(CategoryTransfer $categoryTransfer): void
    {
        $this->getFacade()->updateCategoryStore($categoryTransfer);
    }
}
