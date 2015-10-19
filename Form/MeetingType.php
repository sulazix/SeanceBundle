<?php

namespace Interne\SeanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Interne\SeanceBundle\Entity\ItemRepository;
use AppBundle\Field\FamilleValueType;

class MeetingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', ["label" => "Nom"])
            ->add('date', 'datepicker', ["label" => "Date", "attr" => ["class" => "datepicker"]])
            ->add('place', 'text', ["label" => "Lieu"])

            // Choisir depuis le stack de points
            //*
            ->add('items', 'entity', [
                    'class' => 'InterneSeanceBundle:Item',
                    'property' => 'title',
                    'placeholder' => 'Sélectionner un point',
                    'multiple' => true,
                    'query_builder' => function(ItemRepository $repo) {
                        return $repo->createQueryBuilder('i')
                                ->orderBy('i.title');
                    }
                ])
            
            // TODO : Ajouter la création de points de l'ordre du jour

            ->add('save', 'submit', ["label" => "Enregistrer"]);
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Interne\SeanceBundle\Entity\Meeting'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'interne_seancebundle_meeting';
    }
}
