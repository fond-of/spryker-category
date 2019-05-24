<?php

namespace FondOfSpryker\Zed\Category\Business\Model;

use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\StoreTransfer;
use Spryker\Zed\Category\Business\Model\Category as SprykerCategory;
use Spryker\Zed\Category\Business\Model\Category\CategoryInterface;
use Spryker\Zed\Category\Business\Model\CategoryAttribute\CategoryAttributeInterface;
use Spryker\Zed\Category\Business\Model\CategoryExtraParents\CategoryExtraParentsInterface;
use Spryker\Zed\Category\Business\Model\CategoryNode\CategoryNodeInterface;
use Spryker\Zed\Category\Business\Model\CategoryUrl\CategoryUrlInterface;
use Spryker\Zed\Category\Dependency\Facade\CategoryToEventInterface;
use Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface;

class Category extends SprykerCategory
{
    /**
     * @var \Generated\Shared\Transfer\StoreTransfer
     */
    protected $storeTransfer;

    /**
     * @param \Spryker\Zed\Category\Business\Model\Category\CategoryInterface $category
     * @param \Spryker\Zed\Category\Business\Model\CategoryNode\CategoryNodeInterface $categoryNode
     * @param \Spryker\Zed\Category\Business\Model\CategoryAttribute\CategoryAttributeInterface $categoryAttribute
     * @param \Spryker\Zed\Category\Business\Model\CategoryUrl\CategoryUrlInterface $categoryUrl
     * @param \Spryker\Zed\Category\Business\Model\CategoryExtraParents\CategoryExtraParentsInterface $categoryExtraParents
     * @param \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface $queryContainer
     * @param array $deletePlugins
     * @param array $updatePlugins
     * @param \Spryker\Zed\Category\Dependency\Facade\CategoryToEventInterface|null $eventFacade
     * @param \Generated\Shared\Transfer\StoreTransfer $storeTransfer
     */
    public function __construct(
        CategoryInterface $category,
        CategoryNodeInterface $categoryNode,
        CategoryAttributeInterface $categoryAttribute,
        CategoryUrlInterface $categoryUrl,
        CategoryExtraParentsInterface $categoryExtraParents,
        CategoryQueryContainerInterface $queryContainer,
        array $deletePlugins,
        array $updatePlugins,
        ?CategoryToEventInterface $eventFacade,
        StoreTransfer $storeTransfer
    ) {
        parent::__construct(
            $category,
            $categoryNode,
            $categoryAttribute,
            $categoryUrl,
            $categoryExtraParents,
            $queryContainer,
            $deletePlugins,
            $updatePlugins,
            $eventFacade
        );

        $this->storeTransfer = $storeTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function create(CategoryTransfer $categoryTransfer): void
    {
        $categoryTransfer = $this->addStoreToCategoryTransfer($categoryTransfer);

        parent::create($categoryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return void
     */
    public function update(CategoryTransfer $categoryTransfer): void
    {
        $categoryTransfer = $this->addStoreToCategoryTransfer($categoryTransfer);

        parent::update($categoryTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @return \Generated\Shared\Transfer\CategoryTransfer
     */
    protected function addStoreToCategoryTransfer(CategoryTransfer $categoryTransfer): CategoryTransfer
    {
        if (!$categoryTransfer->getFkStore()) {
            $categoryTransfer->setFkStore($this->storeTransfer->getIdStore());
        }

        return $categoryTransfer;
    }
}
