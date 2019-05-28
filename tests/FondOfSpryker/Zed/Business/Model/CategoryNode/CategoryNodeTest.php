<?php

namespace FondOfSpryker\Zed\Category\Business\Model\CategoryNode;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\NodeTransfer;
use Orm\Zed\Category\Persistence\Base\SpyCategoryNode;

class CategoryNodeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CategoryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $categoryTransferMock;

    /**
     * @var \Generated\Shared\Transfer\NoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $nodeTransferMock;

    /**
     * @var \Orm\Zed\Category\Persistence\Base\SpyCategoryNode|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $categoryNodeEntityMock;

    protected function _before()
    {
        $this->categoryTransferMock = $this->getMockBuilder(CategoryTransfer::class)
            ->disableOriginalConstructor()
            ->setMethods([
                'requireCategoryNode',
                'getCategoryNode',
                'getFkStore'
            ])
            ->getMock();

        $this->nodeTransferMock = $this->getMockBuilder(NodeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryNodeEntityMock = $this->getMockBuilder(SpyCategoryNode::class)
            ->setMethods(['setFkStore'])
            ->getMock();
    }

    public function testCreate(): void
    {
        $this->testSetUpCategoryNodeEntity();
    }

    private function testSetUpCategoryNodeEntity(): void
    {
        $this->categoryTransferMock->fromArray(['fk_store' => 1], true);

        $this->categoryTransferMock
            ->expects($this->once())
            ->method('requireCategoryNode')
            ->willReturn($this->categoryTransferMock);

        $this->categoryTransferMock
            ->expects($this->once())
            ->method('getCategoryNode')
            ->willReturn($this->nodeTransferMock);

        $this->categoryTransferMock
            ->expects($this->once())
            ->method('getFkStore')
            ->willReturn(1);


        $categoryTransfer = $this->categoryTransferMock->requireCategoryNode();
        $fkStore = $categoryTransfer->getFkStore();
        $nodeTransfer = $this->categoryTransferMock->getCategoryNode();

        $this->categoryNodeEntityMock
            ->expects($this->once())
            ->method('setFkStore')
            ->with($this->equalTo($fkStore))
            ->willReturn($this->categoryNodeEntityMock);

        $categoryNodeEntity = $this->categoryNodeEntityMock->setFkStore($fkStore);

        $this->assertInstanceOf(CategoryTransfer::class, $categoryTransfer);
        $this->assertInstanceOf(NodeTransfer::class, $nodeTransfer);
        $this->assertInstanceOf(SpyCategoryNode::class, $categoryNodeEntity);
        $this->assertInternalType("int", $fkStore);
    }
}
