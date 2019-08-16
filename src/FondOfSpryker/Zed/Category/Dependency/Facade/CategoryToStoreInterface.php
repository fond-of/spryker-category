<?php

namespace FondOfSpryker\Zed\Category\Dependency\Facade;

use Generated\Shared\Transfer\StoreTransfer;

interface CategoryToStoreInterface
{
    /**
     * @return \Generated\Shared\Transfer\StoreTransfer
     */
    public function getCurrentStore(): StoreTransfer;
}
