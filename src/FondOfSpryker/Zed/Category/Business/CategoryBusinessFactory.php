<?php

namespace FondOfSpryker\Zed\Category\Business;

use FondOfSpryker\Zed\Category\Business\Model\Category;
use FondOfSpryker\Zed\Category\Business\Model\CategoryNode\CategoryNode;
use FondOfSpryker\Zed\Category\Business\Model\CategoryUrl\CategoryUrl;
use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Store\Persistence\Base\SpyStoreQuery;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Category\Business\CategoryBusinessFactory as SprykerCategoryBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\Category\Persistence\CategoryQueryContainer getQueryContainer()
 */
class CategoryBusinessFactory extends SprykerCategoryBusinessFactory
{
    /**
     * @return \Spryker\Zed\Category\Business\Model\Category
     */
    public function createCategory()
    {
        return new Category(
            $this->createCategoryCategory(),
            $this->createCategoryNode(),
            $this->createCategoryAttribute(),
            $this->createCategoryUrl(),
            $this->createCategoryExtraParents(),
            $this->getQueryContainer(),
            $this->getRelationDeletePluginStack(),
            $this->getRelationUpdatePluginStack(),
            $this->getEventFacade(),
            $this->getStoreTransfer()
        );
    }

    /**
     * @return \Spryker\Zed\Category\Business\Model\CategoryUrl\CategoryUrlInterface
     */
    protected function createCategoryUrl()
    {
        return new CategoryUrl(
            $this->getQueryContainer(),
            $this->getUrlFacade(),
            $this->createUrlPathGenerator(),
            $this->getCategoryUrlPathPlugins()
        );
    }

    /**
     * @return \Spryker\Zed\Category\Business\Model\CategoryNode\CategoryNodeInterface|\Spryker\Zed\Category\Business\Model\CategoryNode\CategoryNodeDeleterInterface
     */
    public function createCategoryNode()
    {
        return new CategoryNode(
            $this->createClosureTableWriter(),
            $this->getQueryContainer(),
            $this->createCategoryTransferGenerator(),
            $this->createCategoryToucher(),
            $this->createCategoryTree(),
            $this->getStoreTransfer()
        );
    }

    /**
     * @throws
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStoreTransfer(): StoreTransfer
    {
        $store = Store::getInstance();
        $spyStoreQuery = SpyStoreQuery::create()
            ->filterByName($store->getStoreName())->findOne();

        $storeTransfer = (new StoreTransfer())
            ->fromArray($spyStoreQuery->toArray(), true);

        return $storeTransfer;
    }
}
