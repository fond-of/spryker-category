<?php

namespace FondOfSpryker\Zed\Category\Business\Model\CategoryNode;

use Generated\Shared\Transfer\CategoryTransfer;
use Orm\Zed\Category\Persistence\SpyCategoryNode;
use Spryker\Zed\Category\Business\Model\CategoryNode\CategoryNode as SprykerCategoryNode;

class CategoryNode extends SprykerCategoryNode
{
    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @throws
     *
     * @return void
     */
    public function create(CategoryTransfer $categoryTransfer): void
    {
        $categoryNodeEntity = new SpyCategoryNode();
        $categoryNodeEntity = $this->setUpCategoryNodeEntity($categoryTransfer, $categoryNodeEntity);
        $categoryNodeEntity->save();

        $categoryNodeTransfer = $this->transferGenerator->convertCategoryNode($categoryNodeEntity);
        $categoryTransfer->setCategoryNode($categoryNodeTransfer);

        $this->closureTableWriter->create($categoryNodeTransfer);
        $this->touchCategoryNode($categoryTransfer, $categoryNodeTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     *
     * @throws
     *
     * @return void
     */
    public function update(CategoryTransfer $categoryTransfer): void
    {
        $categoryNodeTransfer = $categoryTransfer->requireCategoryNode()->getCategoryNode();
        $idCategoryNode = $categoryNodeTransfer->requireIdCategoryNode()->getIdCategoryNode();
        $categoryNodeEntity = $this->getCategoryNodeEntity($idCategoryNode);

        $idFormerParentCategoryNode = $this->findPossibleFormerParentCategoryNodeId(
            $categoryNodeEntity,
            $categoryTransfer
        );

        $categoryNodeEntity = $this->setUpCategoryNodeEntity($categoryTransfer, $categoryNodeEntity);
        $categoryNodeEntity->save();

        $categoryNodeTransfer = $this->transferGenerator->convertCategoryNode($categoryNodeEntity);
        $categoryTransfer->setCategoryNode($categoryNodeTransfer);

        $this->closureTableWriter->moveNode($categoryNodeTransfer);

        $this->touchCategoryNode($categoryTransfer, $categoryNodeTransfer);
        $this->touchPossibleFormerParentCategoryNode($idFormerParentCategoryNode);
    }

    /**
     * @param \Generated\Shared\Transfer\CategoryTransfer $categoryTransfer
     * @param \Orm\Zed\Category\Persistence\SpyCategoryNode $categoryNodeEntity
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryNode
     */
    private function setUpCategoryNodeEntity(CategoryTransfer $categoryTransfer, SpyCategoryNode $categoryNodeEntity): SpyCategoryNode
    {
        $categoryNodeTransfer = $categoryTransfer->requireCategoryNode()->getCategoryNode();
        $parentCategoryNodeTransfer = $categoryTransfer->requireParentCategoryNode()->getParentCategoryNode();

        $categoryNodeEntity->fromArray($categoryNodeTransfer->toArray());
        $categoryNodeEntity->setIsMain(true);
        $categoryNodeEntity->setFkCategory($categoryTransfer->requireIdCategory()->getIdCategory());
        $categoryNodeEntity->setFkParentCategoryNode($parentCategoryNodeTransfer->getIdCategoryNode());
        $categoryNodeEntity->setFkStore($categoryTransfer->getFkStore());

        return $categoryNodeEntity;
    }
}
