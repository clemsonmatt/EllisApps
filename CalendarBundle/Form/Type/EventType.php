<?php

namespace EllisApps\CalendarBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use EllisApps\CalendarBundle\Entity\Calendar;
use EllisApps\CalendarBundle\Entity\Event;

/**
 * @DI\Service("ellisapps.calendar.form.type.calendar_event")
 * @DI\Tag("form.type", attributes={ "alias" = "ellisapps_calendar_event" })
 */
class EventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', [
            'label' => 'Name',
        ]);

        $builder->add('calendar', 'entity', [
            'label'       => 'Category',
            'class'       => 'EllisApps\CalendarBundle\Entity\Calendar',
            'placeholder' => '-- Category --',
            'query_builder' => function (EntityRepository $er) use ($options) {
                return $er->createQueryBuilder('c')
                    ->where('c.category = :category')
                    ->setParameter('category', $options['category']);
            },
        ]);

        $builder->add('location', 'textarea', [
            'label'    => 'Location',
            'required' => false,
            'attr'     => [
                'rows' => 8,
            ],
        ]);

        $builder->add('comments', 'textarea', [
            'label'    => 'Comments',
            'required' => false,
            'attr'     => [
                'rows' => 8,
            ],
        ]);

        $builder->add('startDate', 'date', [
            'label'    => 'Start Date',
            'widget'   => 'single_text',
            'format'   => 'MM/dd/yyyy',
            'html5'    => false,
            'required' => true,
            'attr'     => [
                'class'            => 'datepicker',
                'data-date-format' => 'mm/dd/yyyy',
            ],
        ]);

        $builder->add('endDate', 'date', [
            'label'    => 'End Date',
            'widget'   => 'single_text',
            'format'   => 'MM/dd/yyyy',
            'html5'    => false,
            'required' => true,
            'attr'     => [
                'class'            => 'datepicker',
                'data-date-format' => 'mm/dd/yyyy',
            ],
        ]);

        $builder->add('startTime', 'text', [
            'label'    => 'Start Time',
            'required' => true,
            'attr'     => [
                'class' => 'timepicker',
            ],
        ]);

        $builder->add('endTime', 'text', [
            'label'    => 'End Time',
            'required' => true,
            'attr'     => [
                'class' => 'timepicker',
            ],
        ]);

        $builder->add('recurring', 'choice', [
            'label'       => 'When is the event recurring?',
            'choices'     => Event::getRecurringList(),
            'required'    => false,
            'placeholder' => '-- Occurence --',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EllisApps\CalendarBundle\Entity\Event',
        ));

        $resolver->setRequired('category');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ellisapps_calendar_event';
    }
}
