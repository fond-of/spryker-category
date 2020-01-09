<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

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
            $categoryCreateDataFormProvider->getOptions()
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
}
