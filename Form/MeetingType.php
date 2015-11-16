<?php

namespace Interne\SeanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

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
            // https://github.com/FriendsOfSymfony/FOSRestBundle/issues/808
            ->add('date', 'datetime', ["widget" => "single_text", "date_format" => "dd.MM.yyyy"])
            ->add('place', 'text')
            ->add('items', 'collection', [
                    "type" => new ItemType(),
                    "allow_add" => true,
                    "allow_delete" => true
              ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $meeting = $event->getData();
            $form = $event->getForm();

            if (!$meeting || null === $meeting->getId()) {
              $form
              ->add('container', 'entity', [
                  'class' => 'InterneSeanceBundle:Container',
                  'choice_label' => 'id'
                ]);
            }
        });
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
