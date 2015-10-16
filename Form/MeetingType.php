<?php

namespace Interne\SeanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Interne\SeanceBundle\Field\AddOrSelectValueType;
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
            ->add('items', 'semantic', ["class" => "Interne\SeanceBundle\Entity\Item"])
            /*
            ->add('items', 'entity', [
                    'class' => 'InterneSeanceBundle:Item',
                    'property' => 'title',
                    'placeholder' => 'Créer un nouveau point',
                    'multiple' => true,
                    'query_builder' => function(ItemRepository $repo) {
                        return $repo->getContainerStackedItems();
                    }
                ])
            // Et/Ou créer de nouveaux points
            ->add('items_new', 'collection', [
                    'type' => new ItemType,
                    'allow_add' => true,
                    'allow_delete' => true
                ])
            //*/

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
