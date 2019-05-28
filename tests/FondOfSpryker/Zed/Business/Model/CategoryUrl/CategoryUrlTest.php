<?php

namespace FondOfSpryker\Zed\Category\Business\Model\CategoryUrl;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CategoryTransfer;
use Generated\Shared\Transfer\NodeTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Orm\Zed\Category\Persistence\Base\SpyCategoryNode;

class CategoryUrlTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\UrlTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $urlTransferMock;

    /**
     * @var \Generated\Shared\Transfer\NodeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $nodeTransferMock;

    protected function _before()
    {
        $this->urlTransferMock = $this->getMockBuilder(UrlTransfer::class)
            ->disableOriginalConstructor()
            ->setMethods(['setFkStore'])
            ->getMock();

        $this->nodeTransferMock = $this->getMockBuilder(NodeTransfer::class)
            ->disableOriginalConstructor()
            ->setMethods(['getFkStore'])
            ->getMock();
    }

    public function testSaveLocalizedUrlForNode(): void
    {
        $this->testGetUrlTransferForNode();
    }

    protected function testGetUrlTransferForNode(): void
    {
        $this->nodeTransferMock->fromArray(['fk_store' => 1], true);

        $this->nodeTransferMock
            ->expects($this->once())
            ->method('getFkStore')
            ->willReturn(1);

        $fkStore = $this->nodeTransferMock->getFkStore();

        $this->urlTransferMock
            ->expects($this->once())
            ->method('setFkStore')
            ->with($this->equalTo(1))
            ->willReturn($this->urlTransferMock);

        $urlTransfer = $this->urlTransferMock->setFkStore($fkStore);

        $this->assertInternalType('int', $fkStore);
        $this->assertInstanceOf(UrlTransfer::class, $urlTransfer);
    }
}
