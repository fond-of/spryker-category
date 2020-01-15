<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\Category\Communication\Form\DataProvider;

use FondOfSpryker\Service\Twig\TwigService;
use Spryker\Zed\Category\Business\CategoryFacadeInterface;
use Spryker\Zed\Category\Communication\Form\DataProvider\CategoryEditDataProvider as SprykerCategoryEditDataProvider;
use Spryker\Zed\Category\Dependency\Facade\CategoryToLocaleInterface;
use Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface;

class CategoryEditDataProvider extends SprykerCategoryEditDataProvider
{
    /**
     * @var \FondOfSpryker\Service\Twig\TwigService
     */
    protected $twigService;

    /**
     * CategoryEditDataProvider constructor.
     *
     * @param \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Category\Business\CategoryFacadeInterface $categoryFacade
     * @param \Spryker\Zed\Category\Dependency\Facade\CategoryToLocaleInterface $localeFacade
     * @param \FondOfSpryker\Service\Twig\TwigService $twigService
     */
    public function __construct(
        CategoryQueryContainerInterface $queryContainer,
        CategoryFacadeInterface $categoryFacade,
        CategoryToLocaleInterface $localeFacade,
        TwigService $twigService
    ) {
        parent::__construct($queryContainer, $categoryFacade, $localeFacade);
        $this->twigService = $twigService;
    }

    /**
     * @return array
     */
    protected function getCategoryTemplateChoices(): array
    {
        $availableTemplates = [];
        $templates = $this->queryContainer
            ->queryCategoryTemplate()
            ->find();

        /**
         * @var int $index
         * @var \Orm\Zed\Category\Persistence\SpyCategoryTemplate $template
         */
        foreach ($templates->getData() as $index => $template) {
            if ($this->twigService->isTemplateAvailableInYves($template->getTemplatePath())) {
                $availableTemplates[$template->getIdCategoryTemplate()] = $template->getName();
            }
        }
        return $availableTemplates;
    }
}
