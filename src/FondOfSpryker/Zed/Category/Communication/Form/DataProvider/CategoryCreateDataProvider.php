<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace FondOfSpryker\Zed\Category\Communication\Form\DataProvider;

use FondOfSpryker\Service\Twig\TwigService;
use Spryker\Zed\Category\Communication\Form\DataProvider\CategoryCreateDataProvider as SprykerCategoryCreateDataProvider;
use Spryker\Zed\Category\Dependency\Facade\CategoryToLocaleInterface;
use Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface;

class CategoryCreateDataProvider extends SprykerCategoryCreateDataProvider
{
    /**
     * @var \FondOfSpryker\Service\Twig\TwigService
     */
    protected $twigService;

    /**
     * CategoryCreateDataProvider constructor.
     *
     * @param \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface $queryContainer
     * @param \Spryker\Zed\Category\Dependency\Facade\CategoryToLocaleInterface $localeFacade
     * @param \FondOfSpryker\Service\Twig\TwigService $twigService
     */
    public function __construct(
        CategoryQueryContainerInterface $queryContainer,
        CategoryToLocaleInterface $localeFacade,
        TwigService $twigService
    ) {
        parent::__construct($queryContainer, $localeFacade);
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
