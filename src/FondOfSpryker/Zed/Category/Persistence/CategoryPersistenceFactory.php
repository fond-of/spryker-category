<?php

namespace FondOfSpryker\Zed\Category\Persistence;

use Generated\Shared\Transfer\StoreTransfer;
use Orm\Zed\Store\Persistence\Base\SpyStoreQuery as OrmSpyStoreQuery;
use Spryker\Shared\Kernel\Store;
use Spryker\Zed\Category\Persistence\CategoryPersistenceFactory as SprykerCategoryPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\Category\Persistence\CategoryQueryContainer getQueryContainer()
 * @method \FondOfSpryker\Zed\Category\CategoryConfig getConfig()
 */
class CategoryPersistenceFactory extends SprykerCategoryPersistenceFactory
{
    /**
     * @throws
     *
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getStore(): StoreTransfer
    {
        $store = Store::getInstance();
        $spyStoreQuery = OrmSpyStoreQuery::create();
        $spyStore = $spyStoreQuery->filterByName($store->getStoreName())->findOne();
        $storeTransfer = new StoreTransfer();
        $storeTransfer->fromArray($spyStore->toArray(), true);

        return $storeTransfer;
    }
}
