<?php

namespace FondOfSpryker\Zed\Category\Persistence;

use FondOfSpryker\Zed\Category\CategoryDependencyProvider;
use FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreInterface;
use Spryker\Zed\Category\Persistence\CategoryPersistenceFactory as SprykerCategoryPersistenceFactory;

/**
 * @method \FondOfSpryker\Zed\Category\Persistence\CategoryQueryContainer getQueryContainer()
 * @method \FondOfSpryker\Zed\Category\CategoryConfig getConfig()
 */
class CategoryPersistenceFactory extends SprykerCategoryPersistenceFactory
{
    /**
     * @return \FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreInterface
     */
    public function getStoreFacade(): CategoryToStoreInterface
    {
        return $this->getProvidedDependency(CategoryDependencyProvider::FACADE_STORE);
    }
}
