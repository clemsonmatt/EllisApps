<?php

namespace EllisApps\CalendarBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("ellisapps.calendar.form.type.category")
 * @DI\Tag("form.type", attributes={ "alias" = "ellisapps_calendar_category" })
 */
class CategoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'label' => 'Name',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EllisApps\CalendarBundle\Entity\Category',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ellisapps_calendar_category';
    }
}
