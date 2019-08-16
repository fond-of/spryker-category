<?php

namespace FondOfSpryker\Zed\Category\Business;

use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\NodeTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Category\Business\CategoryFacade as SprykerCategoryFacade;

/**
 * @method \FondOfSpryker\Zed\Category\Business\CategoryBusinessFactory getFactory()
 */
class CategoryFacade extends SprykerCategoryFacade implements CategoryFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function updateCategoryStore(CategoryTransfer $categoryTransfer): void
    {
        $storeFacade = $this->getFactory()->getStoreFacade();
        $categoryTransfer->setFkStore($storeFacade->getCurrentStore()->getIdStore());
    }

    /**
     * @param \Generated\Shared\Transfer\NodeTransfer $categoryNodeTransfer
     *
     * @return void
     */
    public function updateCategoryNodeStore(NodeTransfer $categoryNodeTransfer): void
    {
        $storeFacade = $this->getFactory()->getStoreFacade();
        $categoryNodeTransfer->setFkStore($storeFacade->getCurrentStore()->getIdStore());
    }

    /**
     * @param \Generated\Shared\Transfer\UrlTransfer $urlTransfer
     *
     * @return void
     */
    public function updateUrlStore(UrlTransfer $urlTransfer): void
    {
        $storeFacade = $this->getFactory()->getStoreFacade();
        $urlTransfer->setFkStore($storeFacade->getCurrentStore()->getIdStore());
    }
}
