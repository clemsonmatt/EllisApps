<?php

namespace EllisApps\HelpDeskBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * @DI\Service("ellisapps.helpdesk.form.type.status_history")
 * @DI\Tag("form.type", attributes={ "alias" = "ellisapps_status_history" })
 */
class StatusHistoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('action', 'choice', [
            'label'   => false,
            'mapped'  => false,
            'choices' => [
                'note'  => 'Internal note',
                'reply' => 'Reply',
                'fixed' => 'Fixed',
            ],
            'multiple' => false,
            'expanded' => true,
        ]);

        $builder->add('message', 'textarea', [
            'label' => 'Message',
            'attr'  => [
                'rows' => 4,
            ],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EllisApps\HelpDeskBundle\Entity\StatusHistory',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ellisapps_status_history';
    }
}
