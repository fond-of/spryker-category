<?php

namespace FondOfSpryker\Zed\Category\Communication\Form\DataProvider;

use Generated\Shared\Transfer\CategoryTransfer;
use FondOfSpryker\Zed\Category\Communication\Form\CategoryType;
use Spryker\Zed\Category\Communication\Form\DataProvider\CategoryCreateDataProvider as SprykerCategoryCreateDataProvider;

class CategoryCreateDataProvider extends SprykerCategoryCreateDataProvider
{
    /**
     * @return array
     */
    public function getOptions()
    {
        $parentCategories = $this->getCategoriesWithPaths();

        return [
            static::DATA_CLASS => CategoryTransfer::class,
            CategoryType::OPTION_PARENT_CATEGORY_NODE_CHOICES => $parentCategories,
            CategoryType::OPTION_CATEGORY_QUERY_CONTAINER => $this->queryContainer,
            CategoryType::OPTION_CATEGORY_TEMPLATE_CHOICES => $this->getCategoryTemplateChoices(),
            CategoryType::OPTION_CURRENT_STORE = 4,
        ];
    }
}
