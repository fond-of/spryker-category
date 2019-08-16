<?php

namespace FondOfSpryker\Zed\Category\Business;

use FondOfSpryker\Zed\Category\Business\Model\CategoryUrl\CategoryUrl;
use FondOfSpryker\Zed\Category\CategoryDependencyProvider;
use FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreInterface;
use Spryker\Zed\Category\Business\CategoryBusinessFactory as SprykerCategoryBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\Category\Persistence\CategoryQueryContainer getQueryContainer()
 */
class CategoryBusinessFactory extends SprykerCategoryBusinessFactory
{
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
     * @throws
     *
     * @return \FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreInterface
     */
    public function getStoreFacade(): CategoryToStoreInterface
    {
        return $this->getProvidedDependency(CategoryDependencyProvider::FACADE_STORE);
    }
}
