<?php

namespace FondOfSpryker\Zed\Category;

use FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreBridge;
use Spryker\Zed\Category\CategoryDependencyProvider as SprykerCategoryDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CategoryDependencyProvider extends SprykerCategoryDependencyProvider
{
    public const FACADE_STORE = 'FACADE_STORE';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = $this->addTouchFacade($container);
        $container = $this->addLocaleFacade($container);
        $container = $this->addUrlFacade($container);
        $container = $this->addEventFacade($container);
        $container = $this->addGraphPlugin($container);
        $container = $this->addRelationDeletePluginStack($container);
        $container = $this->addRelationUpdatePluginStack($container);
        $container = $this->addCategoryUrlPathPlugins($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function providePersistenceLayerDependencies(Container $container): Container
    {
        $container = parent::providePersistenceLayerDependencies($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideCommunicationLayerDependencies(Container $container)
    {
        $container = parent::provideCommunicationLayerDependencies($container);
        $container = $this->addStoreFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addStoreFacade(Container $container): Container
    {
        $container[static::FACADE_STORE] = function (Container $container) {
            return new CategoryToStoreBridge($container->getLocator()->store()->facade());
        };

        return $container;
    }
}
