<?php

namespace EllisApps\GenealogyBundle\Form\Type;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use EllisApps\GenealogyBundle\Entity\Person;

/**
 * @DI\Service("ellisapps.genealogy.form.type.person")
 * @DI\Tag("form.type", attributes={ "alias" = "ellisapps_genealogy_person" })
 */
class PersonType extends AbstractType
{
    public function buildForm (FormBuilderInterface $builder, array $options)
    {
        $builder->add('family', 'entity', [
            'label'       => 'Family',
            'required'    => true,
            'class'       => 'EllisApps\GenealogyBundle\Entity\Family',
            'placeholder' => '-- Family Name --',
        ]);

        $builder->add('firstName', 'text', [
            'label'    => 'First Name',
            'required' => true,
        ]);

        $builder->add('lastName', 'text', [
            'label'    => 'Last Name',
            'required' => true,
        ]);

        $builder->add('middleName', 'text', [
            'label'    => 'Middle Name',
            'required' => false,
        ]);

        $builder->add('gender', 'choice', [
            'label'    => 'Gender',
            'required' => true,
            'choices'  => [
                'male'   => 'Male',
                'female' => 'Female',
            ],
            'multiple' => false,
            'expanded' => true,
        ]);

        $builder->add('birthDate', 'date', [
            'label'    => 'Birth Date',
            'widget'   => 'single_text',
            'required' => false,
        ]);

        $builder->add('birthLocation', 'text', [
            'label'    => 'Birth Place',
            'required' => false,
        ]);

        $builder->add('deathDate', 'date', [
            'label'    => 'Death Date',
            'widget'   => 'single_text',
            'required' => false,
        ]);

        $builder->add('deathLocation', 'text', [
            'label'    => 'Death Place',
            'required' => false,
        ]);

        $builder->add('picture', 'file', [
            'label'    => 'Picture',
            'required' => false,
            'mapped'   => false,
        ]);

        $builder->getForm();
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'EllisApps\GenealogyBundle\Entity\Person',
        ]);
    }

    public function getName ()
    {
        return 'ellisapps_genealogy_person';
    }
}
