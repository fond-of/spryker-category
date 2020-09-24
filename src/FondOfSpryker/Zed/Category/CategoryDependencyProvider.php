<?php

namespace FondOfSpryker\Zed\Category;

use FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreBridge;
use Spryker\Zed\Category\CategoryDependencyProvider as SprykerCategoryDependencyProvider;
use Spryker\Zed\Kernel\Container;

class CategoryDependencyProvider extends SprykerCategoryDependencyProvider
{
    public const FACADE_STORE = 'FACADE_STORE';
    public const SERVICE_TWIG = 'SERVICE_TWIG';
    public const CATEGORY_LOCALIZED_ATTRIBUTE_FORM_PLUGINS = 'CATEGORY_LOCALIZED_ATTRIBUTE_FORM_PLUGINS';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);
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
        $container = $this->addTwigService($container);
        $container = $this->addCategoryLocalizedAttributeFormPlugins($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function addTwigService(Container $container): Container
    {
        $container[static::SERVICE_TWIG] = function (Container $container) {
            return $container->getLocator()->twig()->service();
        };

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

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCategoryLocalizedAttributeFormPlugins(Container $container): Container
    {
        $container[static::CATEGORY_LOCALIZED_ATTRIBUTE_FORM_PLUGINS] = function (Container $container) {
            return $this->getCategoryLocalizedAttributeFormPlugins();
        };

        return $container;
    }

    /**
     * @return \Symfony\Component\Form\FormTypeInterface[]
     */
    protected function getCategoryLocalizedAttributeFormPlugins(): array
    {
        return [];
    }
}
