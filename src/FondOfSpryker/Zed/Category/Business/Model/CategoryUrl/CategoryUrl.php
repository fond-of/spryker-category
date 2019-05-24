<?php

namespace FondOfSpryker\Zed\Category\Business\Model\CategoryUrl;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\NodeTransfer;
use Generated\Shared\Transfer\UrlTransfer;
use Spryker\Zed\Category\Business\Model\CategoryUrl\CategoryUrl as SprykerCategoryUrl;

class CategoryUrl extends SprykerCategoryUrl
{
    /**
     * @param \Generated\Shared\Transfer\NodeTransfer $categoryNodeTransfer
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\UrlTransfer
     */
    protected function getUrlTransferForNode(NodeTransfer $categoryNodeTransfer, LocaleTransfer $localeTransfer)
    {
        $urlTransfer = new UrlTransfer();
        $urlTransfer
            ->setFkStore($categoryNodeTransfer->getFkStore())
            ->setFkLocale($localeTransfer->requireIdLocale()->getIdLocale())
            ->setFkResourceCategorynode($categoryNodeTransfer->requireIdCategoryNode()->getIdCategoryNode());

        $urlEntity = $this->findUrlForNode(
            $categoryNodeTransfer->requireIdCategoryNode()->getIdCategoryNode(),
            $localeTransfer
        );
        if ($urlEntity) {
            $urlTransfer->setIdUrl($urlEntity->getIdUrl());
        }

        return $urlTransfer;
    }
}
