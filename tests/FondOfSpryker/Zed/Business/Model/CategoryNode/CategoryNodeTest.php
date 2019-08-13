<?php

namespace FondOfSpryker\Zed\Category\Business\Model\CategoryNode;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CategoryTransfer;
use Orm\Zed\Category\Persistence\SpyCategoryNode;

class CategoryNodeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CategoryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $categoryTransferMock;

    /**
     * @var \Orm\Zed\Category\Persistence\SpyCategoryNode|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $categoryNodeEntity;

    /**
     * @var \Orm\Zed\Category\Persistence\NoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $nodeTransfer;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->categoryTransferMock = $this->getMockBuilder(CategoryTransfer::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'requireCategoryNode',
                'requireParentCategoryNode',
                'requireIdCategory',
                'getFkStore',
                'getCategoryNode',
                'getParentCategoryNode',
            ])
            ->getMock();

        $this->categoryNodeEntity = $this->getMockBuilder(SpyCategoryNode::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'setFkStore',
            ])
            ->getMock();
    }

    /**
     * @return void
     */
    private function testSetUpCategoryNodeEntity(): void
    {
        $this->categoryTransferMock
            ->expects()
            ->method('getCategoryNode')
            ->willReturn($this->nodeTransfer);

        $this->categoryTransferMock
            ->expects()
            ->method('getParentCategoryNode')
            ->willReturn($this->nodeTransfer);
    }
}
