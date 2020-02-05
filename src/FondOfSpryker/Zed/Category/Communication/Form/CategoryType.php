<?php

namespace FondOfSpryker\Zed\Category\Communication\Form;

use Generated\Shared\Transfer\CategoryTransfer;
use Spryker\Zed\Category\Communication\Form\CategoryType as SprykerCategoryType;
use Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface;
use Spryker\Zed\PropelOrm\Business\Runtime\ActiveQuery\Criteria;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * @method \FondOfSpryker\Zed\Category\Business\CategoryFacadeInterface getFacade()
 * @method \FondOfSpryker\Zed\Category\Communication\CategoryCommunicationFactory getFactory()
 * @method \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface getQueryContainer()
 * @method \Spryker\Zed\Category\CategoryConfig getConfig()
 * @method \Spryker\Zed\Category\Persistence\CategoryRepositoryInterface getRepository()
 */
class CategoryType extends SprykerCategoryType
{
    /**
     * @param \Symfony\Component\Form\FormBuilderInterface $builder
     * @param \Spryker\Zed\Category\Persistence\CategoryQueryContainerInterface $categoryQueryContainer
     *
     * @return $this
     */
    protected function addCategoryKeyField(FormBuilderInterface $builder, CategoryQueryContainerInterface $categoryQueryContainer)
    {
        $storeId = $this->getFactory()->getStoreFacade()->getCurrentStore()->getIdStore();
        $builder->add(static::FIELD_CATEGORY_KEY, TextType::class, [
            'constraints' => [
                new NotBlank(),
                new Callback([
                    'callback' => function ($key, ExecutionContextInterface $context) use ($categoryQueryContainer, $storeId) {
                        $data = $context->getRoot()->getData();

                        $exists = false;
                        if ($data instanceof CategoryTransfer) {
                            $exists = $categoryQueryContainer
                                    ->queryCategoryByKey($key)
                                    ->filterByIdCategory($data->getIdCategory(), Criteria::NOT_EQUAL)
                                    ->filterByFkStore($storeId)
                                    ->count() > 0;
                        }

                        if ($exists) {
                            $context->addViolation(sprintf('Category with key "%s" already in use, please choose another one.', $key));
                        }
                    },
                ]),
            ],
        ]);

        return $this;
    }
}
