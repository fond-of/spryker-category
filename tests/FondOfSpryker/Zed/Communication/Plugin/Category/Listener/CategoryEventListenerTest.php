<?php

namespace FondOfSpryker\Zed\Category\Communication\Plugin\Category\Listener;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\Category\Business\CategoryFacade;
use Generated\Shared\Transfer\CategoryTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CategoryEventListenerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CategoryTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $categoryTransferMock;

    /**
     * @var \Spryker\Shared\Kernel\Transfer\TransferInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transferInterfaceMock;

    /**
     * @var \FondOfSpryker\Zed\Category\Business\CategoryFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $categoryFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\Category\Communication\Plugin\Category\Listener\CategoryEventListener|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $categoryEventListenerMock;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->categoryTransferMock = $this->getMockBuilder(CategoryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferInterfaceMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->categoryEventListenerMock = $this->getMockBuilder(CategoryEventListener::class)
            ->setMethods(['getFacade'])
            ->getMock();

        $this->categoryFacadeMock = $this->getMockBuilder(CategoryFacade::class)
            ->disableOriginalConstructor()
            ->setMethods(['updateCategoryStore'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testHandle()
    {
        $this->categoryEventListenerMock
            ->expects($this->atLeastOnce())
            ->method('getFacade')
            ->willReturn($this->categoryFacadeMock);

        $this->categoryFacadeMock
            ->expects($this->atLeastOnce())
            ->method('updateCategoryStore');

        $this->categoryEventListenerMock->handle($this->transferInterfaceMock, 'eventName');
    }
}
