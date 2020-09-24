<?php

namespace FondOfSpryker\Zed\Category\Communication\Form;

use Spryker\Zed\Category\Communication\Form\CategoryLocalizedAttributeType as SprykerCategoryLocalizedAttributeType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @method \FondOfSpryker\Zed\Category\Communication\CategoryCommunicationFactory getFactory()
 */
class CategoryLocalizedAttributeType extends SprykerCategoryLocalizedAttributeType
{
    /**
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this
            ->addFkLocaleField($builder)
            ->addLocaleNameField($builder)
            ->addNameField($builder)
            ->addMetaTitleField($builder)
            ->addMetaDescriptionField($builder)
            ->addMetaKeywordsField($builder)
            ->addPluginForms($builder);
    }

    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     *
     * @return $this
     */
    protected function addPluginForms(FormBuilderInterface $builder)
    {
        foreach ($this->getFactory()->getCategoryLocalizedAttributeFormPlugins() as $formPlugin) {
            $formPlugin->buildForm($builder);
        }

        return $this;
    }
}
