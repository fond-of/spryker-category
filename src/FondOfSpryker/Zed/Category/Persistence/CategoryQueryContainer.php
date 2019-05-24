<?php

namespace FondOfSpryker\Zed\Category\Persistence;

use Orm\Zed\Category\Persistence\Map\SpyCategoryAttributeTableMap;
use Orm\Zed\Category\Persistence\Map\SpyCategoryNodeTableMap;
use Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery;
use Orm\Zed\Locale\Persistence\Map\SpyLocaleTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Category\Persistence\CategoryQueryContainer as SprkyerCategoryQueryContainer;

/**
 * @method \FondOfSpryker\Zed\Category\Persistence\CategoryPersistenceFactory getFactory()
 */
class CategoryQueryContainer extends SprkyerCategoryQueryContainer
{
    /**
     * @api
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategoryAttributeQuery
     */
    public function queryRootNodes(): SpyCategoryAttributeQuery
    {
        return $this->getFactory()->createCategoryAttributeQuery()
            ->joinLocale()
            ->addJoin(
                SpyCategoryAttributeTableMap::COL_FK_CATEGORY,
                SpyCategoryNodeTableMap::COL_FK_CATEGORY,
                Criteria::INNER_JOIN
            )
            ->addAnd(
                SpyCategoryNodeTableMap::COL_IS_ROOT,
                true,
                Criteria::EQUAL
            )
            ->addAnd(
                SpyCategoryNodeTableMap::COL_FK_STORE,
                $this->getFactory()->getStore()->getIdStore(),
                Criteria::EQUAL
            )
            ->withColumn(
                SpyLocaleTableMap::COL_LOCALE_NAME,
                'locale_name'
            )
            ->withColumn(
                SpyCategoryNodeTableMap::COL_ID_CATEGORY_NODE,
                'id_category_node'
            );
    }
}
