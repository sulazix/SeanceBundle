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
            ->add('container', 'entity', [
                'class' => 'InterneSeanceBundle:Container',
                'choice_label' => 'id'
              ])
            ->add('name', 'text')
            // https://github.com/FriendsOfSymfony/FOSRestBundle/issues/808
            ->add('date', 'datetime', ["widget" => "single_text", "date_format" => "dd.MM.yyyy"])
            ->add('place', 'text')
            ->add('items', 'collection', [
                    "type" => new ItemType(),
                    "allow_add" => true,
                    "allow_delete" => true,
                    "by_reference" => true
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
            'data_class' => 'Interne\SeanceBundle\Entity\Meeting',
            'csrf_protection' => false
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
