<?php

namespace Interne\SeanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('date', 'datepicker', ["label" => "Date et heure"])
            ->add('place', 'text', ["label" => "Lieu"])
            ->add('items', 'collection', [
                    "type" => new ItemType,
                    "label" => "Points",
                    "allow_add" => true,
                    "allow_delete" => true
                ])
            /*
            TODO : Use the following template to render the field :
            <div class="ui right labeled left icon input">
              <i class="plus icon"></i>
              <input placeholder="Enter items" type="text">
              <a class="ui circle label">
                Add Item
              </a>
            </div>
             */
            //->add('items', 'semantic', ['class' => 'InterneSeanceBundle:Item'])
            /*
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
            //*/
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
