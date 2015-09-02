<?php

namespace EllisApps\HelpDeskBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use EllisApps\HelpDeskBundle\Entity\Ticket;

/**
 * @DI\Service("ellisapps.helpdesk.form.type.ticket")
 * @DI\Tag("form.type", attributes={ "alias" = "ellisapps_ticket" })
 */
class TicketType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('category', 'choice', [
            'label'   => 'Category',
            'choices' => Ticket::getCategoryList(),
        ]);

        $builder->add('subject', 'text', [
            'label' => 'Subject',
        ]);

        $builder->add('description', 'textarea', [
            'label' => 'Give us a detailed description about what happened',
            'attr'  => [
                'rows' => 10,
            ]
        ]);

        $builder->add('personName', 'text', [
            'label' => 'What is your name?',
        ]);

        $builder->add('personEmail', 'text', [
            'label' => 'What is your email address?',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EllisApps\HelpDeskBundle\Entity\Ticket',
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ellisapps_ticket';
    }
}
