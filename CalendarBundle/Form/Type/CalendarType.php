<?php

namespace EllisApps\CalendarBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use EllisApps\CalendarBundle\Entity\Calendar;

/**
 * @DI\Service("ellisapps.calendar.form.type.calendar")
 * @DI\Tag("form.type", attributes={ "alias" = "ellisapps_calendar" })
 */
class CalendarType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'label' => 'Name',
        ]);

        $builder->add('abbr', 'text', [
            'label' => 'Abbreviation',
        ]);

        $builder->add('color', 'choice', [
            'label'    => 'Color',
            'choices'  => Calendar::getColorList(),
            'expanded' => true,
            'multiple' => false,
        ]);

        $builder->add('category', 'entity', [
            'label'       => 'Category',
            'class'       => 'EllisApps\CalendarBundle\Entity\Category',
            'placeholder' => '-- Category --',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EllisApps\CalendarBundle\Entity\Calendar',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ellisapps_calendar';
    }
}
