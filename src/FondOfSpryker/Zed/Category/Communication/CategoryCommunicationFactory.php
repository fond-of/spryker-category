<?php

namespace FondOfSpryker\Zed\Category\Communication;

use FondOfSpryker\Zed\Category\CategoryDependencyProvider;
use FondOfSpryker\Zed\Category\Communication\Form\CategoryType;
use FondOfSpryker\Zed\Category\Communication\Form\DataProvider\CategoryCreateDataProvider;
use FondOfSpryker\Zed\Category\Communication\Form\DataProvider\CategoryEditDataProvider;
use FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreBridge;
use Generated\Shared\Transfer\CategoryTransfer;
use Spryker\Zed\Category\Communication\CategoryCommunicationFactory as SprykerCategoryCommunicationFactory;
use Symfony\Component\Form\FormInterface;

/**
 * @method \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Category\CategoryConfig getConfig()
 * @method \FondOfSpryker\Zed\Category\Business\CategoryFacadeInterface getFacade()
 * @method \Spryker\Zed\Category\Persistence\CategoryRepositoryInterface getRepository()
 */
class CategoryCommunicationFactory extends SprykerCategoryCommunicationFactory
{
    /**
     * @return \FondOfSpryker\Zed\Category\Dependency\Facade\CategoryToStoreBridge
     */
    public function getStoreFacade(): CategoryToStoreBridge
    {
        return $this->getProvidedDependency(CategoryDependencyProvider::FACADE_STORE);
    }

    /**
     * @param int|null $idParentNode
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createCategoryCreateForm($idParentNode)
    {
        $categoryCreateDataFormProvider = $this->createCategoryCreateFormDataProvider();
        $formFactory = $this->getFormFactory();

        return $formFactory->create(
            CategoryType::class,
            $categoryCreateDataFormProvider->getData($idParentNode),
            $categoryCreateDataFormProvider->getOptions()
        );
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    public function createCategoryEditForm(CategoryTransfer $categoryTransfer): FormInterface
    {
        $categoryCreateDataFormProvider = $this->createCategoryEditFormDataProvider();
        $formFactory = $this->getFormFactory();

        return $formFactory->create(
            CategoryType::class,
            $categoryTransfer,
            $categoryCreateDataFormProvider->getOptions($categoryTransfer->getIdCategory())
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Category\Communication\Form\DataProvider\CategoryCreateDataProvider
     */
    protected function createCategoryCreateFormDataProvider()
    {
        return new CategoryCreateDataProvider(
            $this->getQueryContainer(),
            $this->getLocaleFacade(),
            $this->getProvidedDependency(CategoryDependencyProvider::SERVICE_TWIG)
        );
    }

    /**
     * @return \FondOfSpryker\Zed\Category\Communication\Form\DataProvider\CategoryEditDataProvider
     */
    public function createCategoryEditFormDataProvider()
    {
        return new CategoryEditDataProvider(
            $this->getQueryContainer(),
            $this->getFacade(),
            $this->getLocaleFacade(),
            $this->getProvidedDependency(CategoryDependencyProvider::SERVICE_TWIG)
        );
    }

    /**
     * @return \Spryker\Zed\Category\Dependency\Plugin\CategoryFormPluginInterface[]
     */
    public function getCategoryFormPlugins()
    {
        return $this->getProvidedDependency(CategoryDependencyProvider::PLUGIN_CATEGORY_FORM_PLUGINS);
    }

    /**
     * @return \Spryker\Zed\Category\Dependency\Plugin\CategoryFormPluginInterface[]
     */
    public function getCategoryLocalizedAttributeFormPlugins()
    {
        return $this->getProvidedDependency(CategoryDependencyProvider::CATEGORY_LOCALIZED_ATTRIBUTE_FORM_PLUGINS);
    }
}
