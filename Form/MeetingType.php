<?php

namespace Interne\SeanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Interne\SeanceBundle\Field\ItemValueType;
use Interne\SeanceBundle\Entity\ItemRepository;

class MeetingType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            //->add('date', 'date')
            ->add('place', 'text')

            // Choisir depuis le stack de points
            ->add('items', new ItemValueType, [
                "label" => 'Point(s)'
                ])
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

            ->add('save', 'submit');
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
