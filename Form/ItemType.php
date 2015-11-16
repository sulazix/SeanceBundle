<?php

namespace Interne\SeanceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Interne\SeanceBundle\Transformer\EntityToIdTransformer;
use Interne\SeanceBundle\Form\TagType;

class ItemType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', 'text')
            ->add('position', 'text', ["required" => false])
            ->add('tags', 'collection', [
                "type" => new TagType(),
                'allow_add' => true,
                'allow_delete' => true,
                "required" => false
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $item = $event->getData();
            $form = $event->getForm();

            if (!$item || null === $item->getId()) {
                $form
                    ->add('meeting', 'entity', [
                      'class' => 'InterneSeanceBundle:Meeting',
                      'choice_label' => 'id'
                    ])
                    ->add('description', 'textarea', ["required" => false]);
            } else {
                $form
                    ->add('description', 'textarea');
            }
        });
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Interne\SeanceBundle\Entity\Item',
            'csrf_protection' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'interne_seancebundle_item';
    }

    /**
     * S'occupe d'ajouter une liste des réunions existantes si aucune réunion
     * n'a été spécifiée (en prévision du stack de points).
     * 
     * @param  FormEvent $event L'événement généré par Symfony
     */
    public function onPreSetData(FormEvent $event) {
        $item = $event->getData();
        $form = $event->getForm();


        // Meeting is defined -> keep it as hidden field
        if ($item && null != $item->getMeeting()) {
            $form->add('meeting', 'entity_hidden', ["class" => 'Interne\SeanceBundle\Entity\Meeting']);
        }
        // Meeting is not defined -> generate a select
        else {
            $form->add('meeting', 'entity', [
                'class' => 'InterneSeanceBundle:Meeting',
                'choice_label' => 'name',
                'placeholder' => 'Réserve de points...',
                'empty_value' => null,
                'expanded' => true,
                ]);
        }
    }
}
